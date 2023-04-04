<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserCollection;
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
        Auth::login($user);
        return response()->json($response, 200);
    }

    public function login(LoginRequest $request)
    {

        if (Auth()->attempt($request->validated())) {
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
        } else {
            throw ValidationException::withMessages([
                'Error' => ['Invalid credentials'],
            ]);
        }
    }

    public function loggedInUser()
    {
        try {
            $user = User::where('id', auth()->user()->id)->get();
            return response()->json( new UserCollection($user),200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }
}
