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
    public function destroy($id)
    {
        $page_type=PageType::find($id)->delete();
        return response()->json($page_type);
    }
}
