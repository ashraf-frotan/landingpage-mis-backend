<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            return response()->json([$user,$success],200);
        } 
        else{ 
            return response()->json('fail',505);
        } 
    }

    // Logout
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json('success',200);
    }
}
