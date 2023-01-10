<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {
        $credentials=$request->only('email','password');
        if(!auth()->attempt($credentials)){ 
            throw ValidationException::withMessages([
                'email'=>'Invalid Credentials!'
            ]);
        } 
        $request->session()->regenerate();
        return response()->json(null,201);
    }

    // Logout
    public function logout(Request $request)
    {
        auth()->guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(null,200);
    }

    public function me(){
        $user=Auth::user();
        return response()->json($user);
    }
}
