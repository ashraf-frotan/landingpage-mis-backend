<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Index
    public function index()
    {
        $products=Product::all();
        return response()->json($products);
    }

    // Destroy
    public function destroy($id)
    {
        $products=Product::find($id)->delete();
        return response()->json($products);
    }
}
