<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use File;

class UserController extends Controller
{
    // Index
    public function index()
    {
        $users=User::all();
        return response()->json($users);
    }

    // Store
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|between:6,24|confirmed',
        ]);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $new_name=time().'.'.$ext;
            $file->move('assets/images/profiles',$new_name);
            $data['image']=$new_name;
        }
        $user=User::create($data);
        return response()->json($user);
    }


    // Update
    public function update(Request $request, $id)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required|between:6,24|confirmed',
        ]);
        $user=User::find($id);
        if($request->hasFile('image')){
            if($user->image!="avatar.png"){
                File::delete('assets/images/profiles/'.$user->image);
            }
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $new_name=time().'.'.$ext;
            $file->move('assets/images/profiles',$new_name);
            $data['image']=$new_name;
        }
        $user->update($data);
        return response()->json($user);
    }

    // Destroy
    public function destroy(Request $request,$id)
    {
        $users=User::where('id',$request->all())->get();
        foreach ($users as $user) {
            if($user->image!="avatar.png"){
                File::delete('assets/images/profiles/'.$user->image);
            }
        }
        $users=User::where('id',$request->all())->delete();
        return response()->json($users);
    }
}
