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
    public function destroy($id)
    {
        $country=Country::find($id)->delete();
        return response()->json($country);
    }

    // Search
    public function search(Request $request)
    {
        $countries=DB::table('countries');
        if($request->id!=''){
            $countries->where('id','like',$request->id);
        }
        if($request->code!=''){
            $countries->where('id','like',"%$request->id%");
        }
        if($request->name!=''){
            $countries->where('id','like',"%$request->name%");
        }
        if($request->phonecode!=''){
            $countries->where('id','like',"%$request->phonecode%");
        }
        $countries->get();
        return response()->json($countries);
    }
}
