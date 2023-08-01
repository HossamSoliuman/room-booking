<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse(
            [
                'token' => $token,
                'user' => $user,
            ],
        );
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return $this->errorResponse('User name or Password is wrong', 401);
        }

        $user = User::where('email', $validated['email'])->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse(
            [
                'token' => $token,
                'user' => $user,
            ],
        );
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->messageResponse(
            'Successfully logedout'
        );
    }
}
