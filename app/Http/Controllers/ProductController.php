<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Country;
use App\Models\PageType;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Template;

class ProductController extends Controller
{
    // Index
    public function index()
    {
        $products=Product::all();
        return response()->json($products);
    }

    // Store
    public function store(Request $request)
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
        $product=Product::create($data);
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
