<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use JWTAuth;
use DB;

class APILoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->all(), 'status' => 'error']);
        }
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => ['invalid credentials'], 'status' => 'error'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => ['could not create token'], 'status' => 'error'], 500);
        }
        
        return $this->respondWithToken($token);
    }
}
