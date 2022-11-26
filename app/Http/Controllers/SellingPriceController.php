<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellingPrice;

class SellingPriceController extends Controller
{
   // Index
   public function index()
   {
       $selling_prices=SellingPrice::all();
       return response()->json($selling_prices);
   }

   // Store
   public function store(Request $request)
   {
       $data=$request->validate([
           'quantity'=>'required',
           'price'=>'required',
           'old_price'=>'required',
       ]);
       $selling_price=SellingPrice::create($data);
       return response()->json($selling_price);
   }

   // Update
   public function update(Request $request,$id)
   {
       $data=$request->validate([
            'quantity'=>'required',
            'price'=>'required',
            'old_price'=>'required',
       ]);
       $selling_price=SellingPrice::find($id);
       $selling_price->update($data);
       return response()->json($selling_price);
   }

   // Destroy
   public function destroy($id)
   {
       $selling_price=SellingPrice::find($id)->delete();
       return response()->json($selling_price);
   }
}
