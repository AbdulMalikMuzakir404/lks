<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = $request->validate([
            'nickname' => 'required|string',
            'password' => 'required|string|min:6'
        ]);

        if(!Auth::attempt($validate)) {
            return response()->json([
                'message' => 'Invalid credentials.'
            ], 403);
        }

        return response()->json([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }
}
