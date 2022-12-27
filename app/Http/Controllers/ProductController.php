<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SellingPrice;
use App\Models\Template;
use App\Models\SubProduct;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    // Index
    public function index()
    {
        $products=Product::with(['template.company'])->get();
        return response()->json($products);
    }

    public function show($slug)
    {
        $product=Product::with(['productImages','sellingPrices','subProducts','template.company.country'])->where('page_link',$slug)->first();
        return response()->json($product);
    }

    // Store
    public function store(Request $request)
    {
        $data=json_decode($request->landing_info);
        // $data=$data->validate([
        //     'pcode'=>'required|min:3',
        //     'title_ar'=>'required_without:title_en',
        //     'title_en'=>'required_without:title_ar',
        //     'desc_ar'=>'required_without:desc_en',
        //     'desc_en'=>'required_without:desc_ar',
        //     'message_ar'=>'required_without:message_en',
        //     'message_en'=>'required_without:message_ar',
        //     'page_link'=>'required|min:6',
        //     'page_language'=>'required',
        //     'is_collection'=>'required',
        //     'template_id'=>'required',
        // ]);
        $pcode=strtoupper($data->pcode);
        $product=new Product();
        $product->pcode=$pcode;
        $product->title_ar=$data->title_ar;
        $product->title_en=$data->title_en;
        $product->desc_ar=$data->desc_ar;
        $product->desc_en=$data->desc_en;
        $product->message_ar=$data->message_ar;
        $product->message_en=$data->message_en;
        $product->page_link=Str::slug($data->title_en);
        $product->sale_type=$data->sale_type;
        $product->page_language=$data->page_language;
        $product->is_collection=$data->is_collection;
        $product->template_id=$data->template_id;
        $product->template_id=$data->template_id;
        $product->save();
        // Store prices
        foreach ($data->prices as $price) {
            SellingPrice::create(['product_id'=>$product->id,'quantity'=>$price->quantity,'price'=>$price->price,'old_price'=>$price->old_price]);
        }
        // Store sub collection_items
        foreach ($data->collection_items as $item) {
            $item=strtoupper($item);
            SubProduct::create(['pcode'=>$item,'product_id'=>$product->id]);
        }

        if($request->hasFile('s_images')){
           $files=$request->file('s_images');
           foreach ($files as $file) {
             ProductImage::create(['name'=>$pcode."'/S'/".$file->getClientOriginalName(),'type'=>0,'product_id'=>$product->id]);
             $file->move('assets/images/products/'.$pcode.'/S',$file->getClientOriginalName());
           }
            
        }
        if($request->hasFile('l_images')){
            $files=$request->file('l_images');
            foreach ($files as $file) {
                ProductImage::create(['name'=>$pcode."'/L'/".$file->getClientOriginalName(),'type'=>1,'product_id'=>$product->id]);
                $file->move('assets/images/products/'.$pcode.'/L',$file->getClientOriginalName());
            }
        }
        return response()->json($product);
    }

    // Update
    public function update(Request $request,$id)
    {
        $data=$request->validate([
            'pcode'=>'required|min:3',
            'title_ar'=>'required_without:title_en',
            'title_en'=>'required_without:title_ar',
            'desc_ar'=>'required_without:desc_en',
            'desc_en'=>'required_without:desc_ar',
            'message_ar'=>'required_without:message_en',
            'message_en'=>'required_without:message_ar',
            'page_link'=>'required|min:6',
            'page_language'=>'required'
            
        ]);
        $product=Product::find($id);
        $product->update($data);
        return response()->json($product);
    }

    // Destroy
    public function destroy($id)
    {
        $products=Product::find($id)->delete();
        return response()->json($products);
    }

    // Get All Required data for creating landing page
    public function getInfo()
    {
        $countries=Country::all();
        $companies=Company::all();
        $templates=Template::all();
        return response()->json(['countries'=>$countries,'companies'=>$companies,'templates'=>$templates]);
    }

}
