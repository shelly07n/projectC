<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    public function createUser(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
            ]);




            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                "referral_code" =>  'shelton' . Str::random(10) . 'ton'
            ]);

            $response = [
                'status' => '200',
                'message' => 'User created successfully',
                'data' => $user
            ];

            return $response;
            // $token = $user->createToken('AppName')->accessToken;
            // return response()->json(['token' => $token], 201);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 'failure',
                "line" => $e->getMessage()
            ]);
        }
    }


    public function login(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $this->generateToken($user);

            return response()->json(['access_token' => $token]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    protected function generateToken($user)
    {
        $payload = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->id == 1 ? "admin" : "contestant",
            'exp' => time() + 3600, // Token expiration time (e.g., 1 hour)
        ];

        return JWT::encode($payload, 'shelton','HS256');
    }
}
