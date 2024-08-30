<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ResponseTrait;

    public function register(RegisterRequest $requset)
    {
        $user = User::create($requset->validated());
        return $this->returnSuccess('register success',201);
    }

    public function login(LoginRequest $requset)
    {
        if (!$token = auth('api')->attempt($requset->validated())) {
            return $this->returnError('Unauthenticated',401);
        }
        return $this->respondWithToken($token);
    }

    public function profile()
    {

        return $this->returnData(auth('api')->user(),true,200);
    }

    public function logout()
    {
        DB::beginTransaction();
        JWTAuth::invalidate(JWTAuth::getToken());
        DB::commit();
        return $this->returnSuccess('Successfully logged out',200);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ]);
    }
}
