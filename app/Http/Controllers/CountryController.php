<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use DB;

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

    // Update
    public function update(Request $request,$id)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'code'=>'required|min:2',
            'phonecode'=>'required|min:2',
        ]);
        $country=Country::find($id);
        $country->update($data);
        return response()->json($country);
    }

    // Destroy
    public function destroy(Request $request,$id)
    {
        $country=Country::whereIn('id',$request->all())->delete();
        return response()->json($country);
    }

    // Filter
    public function filter(Request $request)
    {
        $query=Country::query();
        if($request->id!=''){
            $query->where('id',$request->id);
        }
        $countries=$query->where('code','like',"%$request->code%")
        ->where('name','like',"%$request->name%")
        ->where('phonecode','like',"%$request->phonecode%")
        ->get();
        return response()->json($countries);
    }
}
