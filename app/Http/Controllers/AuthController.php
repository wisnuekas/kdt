<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $staffScopes = ['*'];
        $customerScopes = [];

        $creds = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!auth()->attempt($creds)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        if(auth()->user()->isCustomer()) {
            $token = auth()->user()->createToken('accessToken', $customerScopes)->accessToken;
        } else {
            $token = auth()->user()->createToken('accessToken', $staffScopes)->accessToken;
        }

        return response()->json([
            'message' => 'Login success',
            'access_token' => $token
        ], 200);
    }

    public function logout()
    {
        $user = auth()->user();
        $user->token()->revoke();

        return response()->json(['message' => 'You logged out succesfully!']);
    }
}
