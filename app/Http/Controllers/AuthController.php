<?php

namespace App\Http\Controllers;

use App\Mail\welcome;
use App\Models\contestants;
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
            ]);

            if($user){
                $subject = " Welcome to Sheltez - Your Username and Password Inside";
                $userName = $user->name;
                $userEmail = $user->email;
                $password = $request->password;
                $currentDomain = $request->getSchemeAndHttpHost();


                $isSent = \Mail::to($userEmail)->send(new welcome(
                    $subject,
                    $userName,
                    $userEmail,
                    $password,
                    $currentDomain
                ));

            }

            $response = [
                'status' => '200',
                'message' => 'User created successfully',
                'data' => $user,
                'mail' => $isSent
            ];

            return $response;
        } catch (\Exception $e) {
            return response()->json([
                "status" => 'failure',
                "line" => $e->getMessage()
            ],401);
        }
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $this->generateToken($user);
            return response()->json(['access_token' => $token,
            'status' => 200,
            'Message' => "Successfully"],200
        );
        }

        return response()->json(['status' => 401,
        'Message' => "User doesn't exists register and login"
    ], 401);
    }

//  Generate JWt token for user
    protected function generateToken($user)
    {

        $canShowReferral =  contestants::where('user_id',$user->id )->exists();
        $payload = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->id == 1 ? "admin" : "contestant",
            'canShowReferral' => $user->id == 1 ? false :  !$canShowReferral,
            'exp' => time() + 3600 * 3 , //# Hours
        ];

        return JWT::encode($payload, 'shelton', 'HS256');
    }
}
