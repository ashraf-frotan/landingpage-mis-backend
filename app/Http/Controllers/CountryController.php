<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use DB;
use File;

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
            'flag'=>'required',
        ]);
        if($request->hasFile('flag')){
            $file=$request->file('flag');
            $ext=$file->getClientOriginalExtension();
            $new_name=time().'.'.$ext;
            $file->move('assets/images/flag',$new_name);
            $data['flag']=$new_name;
        }
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
        if($request->hasFile('flag')){
            if($country->flag!=''){
                File::delete('assets/images/flag/'.$this->fileName($country->flag));
            }
            $file=$request->file('flag');
            $ext=$file->getClientOriginalExtension();
            $new_name=time().'.'.$ext;
            $file->move('assets/images/flag',$new_name);
            $data['flag']=$new_name;
        }
        $country->update($data);
        return response()->json($country);
    }

    // Destroy
    public function destroy(Request $request,$id)
    {
        $countries=Country::whereIn('id',$request->all())->get();
        foreach($countries as $country){
            if($country->flag!=''){
                File::delete('assets/images/flag/'.$this->fileName($country->flag));
            }
        }
        $countries=Country::whereIn('id',$request->all())->delete();
        return response()->json($countries);
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


    public function fileName($path)
    {
        $pos=strripos($path,'/');
        return substr($path,$pos+1);
    }
}
