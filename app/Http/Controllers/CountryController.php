<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // Index
    public function index()
    {
        $countries=Country::all();
        return response()->json($countries);
    }

    // Store
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'code'=>'required|min:2',
            'phonecode'=>'required|min:2',
        ]);
        $country=Country::create($data);
        return response()->json($country);
    }

    // Updated
    public function update(Request $request,$id)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'code'=>'required|min:2',
            'phonecode'=>'required|min:2',
        ]);
        $country=Country::find($id);
        $country->update($data);
        return response()->json(['data'=>$country,'status'=>true,'message'=>'Country inserted successfully!']);
    }

    // Destroy
    public function destroy($id)
    {
        $country=Country::find($id)->delete();
        return response()->json(['data'=>$country,'status'=>true,'message'=>'Country deleted successfully!']);
    }
}
