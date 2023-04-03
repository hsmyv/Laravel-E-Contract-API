<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken('myappToken')->plainTextToken;
        $response = authResponse($user, $token);

        return response()->json($response, 200);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::guard('web')->attempt($request->validated())) {

            $user = Auth::user();

            $token = $user->createToken('myappToken')->plainTextToken;

            $response = authResponse($user, $token);

            return response()->json($response, 200);
        } else {
            throw ValidationException::withMessages([
                'Error' => ['Invalid credentials'],
            ]);
        }
    }

    public function getAuthUser()
    {
        $user = Auth::user();
        return response()->json(['data' => $user->name], 200);
    }
}
