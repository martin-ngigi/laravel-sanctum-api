<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        //validate the request
        $fields = $request->validate([
            'name' =>'required|string|max:255',
            'email' =>'required|string|email|max:255|unique:users',
            'password' =>'required|string|min:6|confirmed'
        ]);

        //create user
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']), //bcrypt for hashing password.
        ]);

        //create token
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


    //
    public function login(Request $request){
        //validate the request
        $fields = $request->validate([
            'email' =>'required|string',
            'password' =>'required|string'
        ]);

        //chek email
        $user = User::where('email', $fields['email'])->first();

        //check password
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Invalid email or password.'
            ], 401);
        }

        //create token
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request){
        //auth()->user()->tokens()->delete();

        // Revoke the token that was used to authenticate the current request...
        $request->user()->currentAccessToken()->delete();

        // Revoke the token that was used to authenticate the current request...
       // $request->user()->tokens()->delete();
        return [
            "message"=>"Logout success"
        ];
    }
}
