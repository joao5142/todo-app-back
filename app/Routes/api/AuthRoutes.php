<?php

namespace App\Routes\api;

use App\Http\Requests\AuthUserRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class AuthRoutes
{
    public static function getRoutes()
    {
        Route::post('/login', function (AuthUserRequest $request) {
            $credentials = $request->only(['email', 'password']);

            $token = auth()->attempt($credentials);

            if (!$token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return response()->json(['message' => 'Usúario Autenticado', 'token' => $token, 'token_type' => 'bearer', 'expires_in' => auth()->factory()->getTTL() * 60]);
        });

        Route::middleware('auth:api')->post('/logout', function () {
            auth()->logout();
            return response()->json(['message' => 'Usúario deslogado']);
        });
    }
}
