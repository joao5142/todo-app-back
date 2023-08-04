<?php

namespace App\Routes\api;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

class TaskRoutes
{
    public static function getRoutes()
    {

        Route::group(['middleware' => 'auth:api', 'prefix' => 'task'], function () {
            Route::get('/all', [TaskController::class, 'index'])->name('all_tasks');

            Route::post('/save', [TaskController::class, 'store'])->name('save_task');

            Route::get('/show/{taskId}', [TaskController::class, 'show'])->name('task_show');

            Route::patch('/edit/{taskId}', [TaskController::class, 'update'])->name('update_task');

            Route::delete('/delete/{taskId}', [TaskController::class, 'destroy'])->name('delete_task');
        });
    }
}
