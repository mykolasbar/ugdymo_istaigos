<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authorizationController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);

        $user = User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>Hash::make($fields['password']),
        ]);

        // $token = $user->createToken('appToken')->plainTextToken;

        // return response (['user'=>$user, 'token' =>$token]);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $user = User::where('email', $fields['email'])->first();

        // return response (['user'=>$user, 'token' => $user->createToken('appToken', ['user-abilities'])->plainTextToken]);

        if ($user && Auth::attempt(['email' => $fields['email'], 'password' => $fields['password']])) {
            if ($user->role === "user")
                return response (['user'=>$user, 'token' => $user->createToken('appToken', ['user-abilities'])->plainTextToken]);
                // return "user";

            if ($user->role === "admin")
                return response (['user'=>$user, 'token' => $user->createToken('appToken', ['admin-abilities'])->plainTextToken]);
                // return "admin";

        }
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
    }
}
