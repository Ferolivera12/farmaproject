<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Perform authentication logic (e.g., using Laravel auth)
        if (Auth::attempt($credentials)) {
            return $this->handleLogin($request);
        }

        // Respond with error if login fails
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    private function handleLogin(Request $request)
    {
        $user = auth()->user(); // Get authenticated user instance
        $token = $user->createToken('auth_token'); // Use createToken method on user

        // Customize the response if needed (e.g., include user details)
        return response()->json([
            'token' => $token->plainTextToken, // Access token directly in Laravel 10
            'user' => $user, // Include user information (optional)
        ]);
    }
}
