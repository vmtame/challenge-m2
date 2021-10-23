<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class LoginController extends Controller
{
  public function login(LoginRequest $request) {
    if(!Auth::attempt(($request->only('email', 'password'))))
    {
      return response()->json([
        'message' => 'Invalid login',
      ], 401);
    }

    $user = User::where('email', $request->email)->firstOrFail();
    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json(['token' => $token]);
  }

  public function logout(Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json([
      'message' => 'Logged out'
    ]);
  }

  public function user(Request $request) {
    return $request->user();
  }

  public function register(RegisterRequest $request) {
    $user = User::create([
      'email' => $request->email,
      'name' => $request->name,
      'password' => Hash::make($request->password)
    ]);

    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json([
      'token' => $token
    ], 201);
  }
}
