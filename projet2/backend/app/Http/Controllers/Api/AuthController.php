<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provide credentials are incorrect'
            ], 401);
        }

        $token = $user->createToken($user->name . 'Auth-Token')->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'token_type' => 'Bearer',
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();
        if ($user) {
            $user->tokens()->delete();

            return response()->json([
                'message' => 'Logged out successfuly',

            ], 200);
        } else {
            return response()->json([
                'message' => 'User not Found.',

            ], 200);
        }
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|max:255',
            'password_confirmation' => 'required|string|min:8|max:255'
        ]);

        if ($request->password === $request->password_confirmation) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            return response()->json(["invalid password"]);
        }

        if ($user) {
            $token = $user->createToken($user->name . 'Auth-Token')->plainTextToken;
            return response()->json([
                'message' => 'Registration Successful',
                'token_type' => 'Bearer',
                'token' => $token
            ], 200);
        } else {
            $token = $user->createToken($user->name . 'Auth-Token')->plainTextToken;
            return response()->json([
                'message' => 'Something went wrong!',
            ], 500);
        }
    }

    public function profile(Request $request)
    {
        if ($request->user()) {
            return response()->json([
                'message' => 'Profile Fetched',
                'data' => $request->user()
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not Authenticated.',
            ], 401);
        }
    }
}
