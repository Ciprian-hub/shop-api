<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'boolean'
        ]);
        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if(!Auth::attempt($credentials, $remember)) {
            return response([
                'message' => 'Email or password incorrect'
            ], 422);
        }

        /** @var  $user */

        $user = Auth::user();

//        if(!$user->is_admin) {
//
//            Auth::logout();
//            return response([
//                'message' => 'You don/t have permission to auth as admin'
//            ], 403);
//        }

        $token = $user->createToken('main')->plainTextToken;
        return response([
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }

    public function logout (Request $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        /** @var  $user */
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response([
            'success' => true
        ]);
    }

    public function getUser(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
