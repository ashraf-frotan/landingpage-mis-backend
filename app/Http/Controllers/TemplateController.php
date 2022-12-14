<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\Template;

class TemplateController extends Controller
{
    // Index
    public function index()
    {
        $templates=Template::with('company')->get();
        return response()->json($templates);
    }

    // Store
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'phone'=>'required|min:10',
            'image'=>'required',
            'type'=>'required',
            'company_id'=>'required'
        ]);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $new_name=time().'.'.$ext;
            $file->move('assets/images/template',$new_name);
            $data['image']=$new_name;
        }
        $template=Template::create($data);
        $template=Template::with('company')->where('id',$template->id)->first();
        return response()->json($template);
    }

    // Update
    public function update(Request $request,$id)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'phone'=>'required|min:10',
            'type'=>'required',
            'company_id'=>'required'
        ]);
        $template=Template::find($id);
        if($request->hasFile('image')){
            if($template->image!=''){
                File::delete('assets/images/template/'.fileName($template->image));
            }
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $new_name=time().'.'.$ext;
            $file->move('assets/images/template',$new_name);
            $data['image']=$new_name;

        }
        $template->update($data);
        return response()->json($template);
    }

    // Destroy
    public function destroy(Request $request,$id)
    {
        $templates=Template::whereIn('id',$request->all())->get();
        foreach($templates as $template){
            if($template->image!=''){
                File::delete('assets/images/template/'.fileName($template->image));
            }
        }
        $templates=Template::whereIn('id',$request->all())->delete();
        return response()->json($templates);
    }

    // Filter
    public function filter(Request $request){
        $query=Template::query()->with('company');
        if($request->id!=''){
            $query->where('id',$request->id);
        }
        if($request->type!=''){
            $query->where('type',$request->type);
        }
        $templates=$query->where('name','like',"%$request->name%")->where('phone','like',"%$request->phone%")->get();
        return response()->json($templates);
    }


}
