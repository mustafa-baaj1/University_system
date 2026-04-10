<?php

namespace App\Http\Controllers\Api;

use App\Events\myevent;
use App\Events\testevent;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterForm;
use App\Jobs\sendWelcome;
use App\Mail\welcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function register(RegisterForm $request){

        $validated = $request->validated();

        $user = User::create($validated);

        $token = JWTAuth::fromUser($user);

        event(new myevent($user));

        return response()->json(["user"=>$user , "token"=>$token]);

    }

    public function login(Request $request){
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => "validation error",
                "errors" => $validator->errors()
            ], 422);
        }

        // Get credentials
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate and get token
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                "status" => "error",
                "message" => "invalid credentials"
            ], 401);
        }

        // Get authenticated user
        $user = auth('api')->user();

        return response()->json([
            "status" => "success",
            "user" => $user,
            "token" => $token
        ]);

    }

    public function logout(){
        try {
            // Invalidate the token for JWT authentication
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                "status" => "success",
                "message" => "successfully logged out"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "failed to logout",
                "error" => $e->getMessage()
            ], 500);
        }
    }

}
