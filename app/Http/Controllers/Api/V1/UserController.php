<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken('myappToken')->plainTextToken;
        $response = authResponse($user, $token);
        Auth::login($user);
        return response()->json($response, 200);
    }

    public function login(LoginRequest $request)
    {
        
        session()->regenerate();
        $user = Auth::user();

        $success['token'] = $user->createToken('myappToken')->plainTextToken;

        $success['name']  = $user->name;

        $response = [
            'success' => true,
            'data'    => $success,
            'message' => "created"
        ];
        return response()->json($response, 200);
    }

    public function loggedInUser()
    {
        try {
            if (Auth::check()) {
                $userId = Auth::user()->id;
                $user = User::where('id', $userId)->first();
                return new UserResource($user);
            } else {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
