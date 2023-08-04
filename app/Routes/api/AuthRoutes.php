<?php

namespace App\Routes\api;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class AuthRoutes
{
    public static function getRoutes()
    {
        Route::post('/login', function (Request $request) {
            $credentials = $request->only(['email', 'password']);

            $token = auth()->attempt($credentials);

            if (!$token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return response()->json(['data' => ['token' => $token, 'token_type' => 'bearer', 'expires_in' => auth()->factory()->getTTL() * 60]]);
        });

        Route::post('/logout', function (Request $request) {
            auth()->logout();
            return response()->json(['success' => 'User logout successfully']);
        });
    }
}
