<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageType;

class PageTypeController extends Controller
{
    // Index
    public function index()
    {
        $page_types=PageType::with('company')->get();
        return response()->json($page_types);
    }

    // Store
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'company_id'=>'required',
        ]);
        $page_type=PageType::create($data);
        $page_type=PageType::with('company')->where('id',$page_type->id)->first();
        return response()->json($page_type);
    }

    // Update
    public function update(Request $request,$id)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'company_id'=>'required',
        ]);
        $page_type=PageType::find($id);
        $page_type->update($data);
        return response()->json($page_type);
    }

    // Destroy
    public function destroy(Request $request,$id)
    {
        $page_type=PageType::whereIn('id',$request->all())->delete();
        return response()->json($page_type);
    }

    // Filter
    public function filter(Request $request)
    {
        $query=PageType::query()->with('company');
        if($request->id!=''){
            $query->where('id',$request->id);
        }
        if($request->company_id!=''){
            $query->where('company_id',$request->company_id);
        }
        $page_types=$query->where('name','like',"%$request->name%")->get();
        return response()->json($page_types);
    }
}
