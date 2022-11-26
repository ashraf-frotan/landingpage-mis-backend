<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubProduct;

class SubProductController extends Controller
{
    // Index
    public function index()
    {
        $sub_products=SubProduct::all();
        return response()->json($sub_products);
    }

    // Store
    public function store(Request $request)
    {
        $data=$request->validate([
            'pcode'=>'required|min:3',
            'title'=>'required|min:3',
            'product_id'=>'required',
        ]);
        $sub_product=SubProduct::create($data);
        return response()->json($sub_product);
    }

    // Update
    public function update(Request $request,$id)
    {
        $data=$request->validate([
            'pcode'=>'required|min:3',
            'title'=>'required|min:3',
            'product_id'=>'required',
        ]);
        $sub_product=SubProduct::find($id);
        $sub_product->update($data);
        return response()->json($sub_product);
    }

    // Destroy
    public function destroy($id)
    {
        $sub_product=SubProduct::find($id)->delete();
        return response()->json($sub_product);
    }
}
