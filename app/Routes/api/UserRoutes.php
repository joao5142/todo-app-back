<?php

namespace App\Routes\api;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

class UserRoutes
{
    public static function getRoutes()
    {
        Route::group(['prefix' => 'user'], function () {
            Route::post('/save', [UserController::class, 'store'])->name('save_user');
            Route::middleware('api')->get('/show/{userId}', [UserController::class, 'show'])->name('user_show');
        });
    }
}
