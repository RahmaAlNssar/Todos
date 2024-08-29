<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(UserRequest $requset) {
       $user= User::create(array_merge($requset->except('password'),['password'=>Hash::make($requset->password)]));
        return response()->json($user, 201);
    }

    public function login(UserRequest $requset)
    {
        if (! $token = auth('api')->attempt($requset->all())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        try{
            DB::beginTransaction();
            JWTAuth::invalidate(JWTAuth::getToken());

            DB::commit();
            return response()->json(['message' => 'Successfully logged out']);

        }catch(\Exception $e){
            dd($e);
            return response()->json($e->getMessage());
        }
        

    }

    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }
}   