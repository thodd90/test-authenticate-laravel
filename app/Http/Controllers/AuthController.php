<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
//    public function __construct()
//    {
//
//    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $cookie = cookie('auth_token', $user->id, 60*24*7);

        return response()->json(['user' => $user])->withCookie($cookie);
    }

    public function me(){
        return response()->json(Auth::user());
    }
}
