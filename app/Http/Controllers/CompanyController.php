<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use File;
use DB;
class CompanyController extends Controller
{
    // Index
    public function index()
    {
        $companies=Company::with('country')->get();
        return response()->json($companies);
    }

    // Store
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'domain'=>'required|min:3',
            'logo'=>'required',
            'country_id'=>'required'
        ]);
        if($request->hasFile('logo')){
            $file=$request->file('logo');
            $ext=$file->getClientOriginalExtension();
            $new_name=time().'.'.$ext;
            $file->move('assets/images/logo',$new_name);
            $data['logo']=$new_name;
        }
        $company=Company::create($data);
        $company=Company::with('country')->where('id',$company->id)->first();
        return response()->json($company);
    }

    // Update
    public function update(Request $request,$id)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'domain'=>'required|min:3',
            'country_id'=>'required'
        ]);
        $company=Company::find($id);
        if($request->hasFile('logo')){
            if($company->logo!=''){
                File::delete('assets/images/logo/'.$company->logo);
            }
            $file=$request->file('logo');
            $ext=$file->getClientOriginalExtension();
            $new_name=time().'.'.$ext;
            $file->move('assets/images/logo',$new_name);
            $data['logo']=$new_name;
        }
        $company->update($data);
        return response()->json($company);
    }

    // Destroy
    public function destroy(Request $request,$id)
    {
        $companies=Company::whereIn('id',$request->all())->get();
        foreach($companies as $company){
            if($company->logo!=''){
                File::delete('assets/images/logo/'.$company->logo);
            }
        }
        $companies=Company::whereIn('id',$request->all())->delete();
        return response()->json($companies);
    }

    // Filter
    public function filter(Request $request)
    {
       $query=Company::query()->with('country');
       if($request->id!=''){
        $query->where('id',$request->id);
       }
       if($request->country_id!=''){
        $query->where('country_id',$request->country_id);
       }
       $companies=$query->where('name','like',"%$request->name%")->get();
       return response()->json($companies);
    }
}
