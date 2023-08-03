<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',function(Request $request){
     $credentials= $request->only(['email','password']);

     if(!auth()->attempt($credentials)){
        return response()->json(['error'=>'User not authenticated'],400);
     }
});

Route::post('/user/save',[UserController::class, 'store'])->name('save_user');
Route::get('/user/show/{userId}', [UserController::class, 'show'])->name('user_show');

Route::get('/task/all', [TaskController::class, 'index'])->name('all_tasks');

Route::get('/task/create', [TaskController::class, 'create'])->name('create_task');


Route::post('/task/save', [TaskController::class, 'store'])->name('save_task');

Route::get('/task/show/{taskId}', [TaskController::class, 'show'])->name('task_show');

Route::get('/task/edit/{taskId}', [TaskController::class, 'edit'])->name('edit_task');

Route::put('/task/update/{taskId}', [TaskController::class, 'update'])->name('update_task');

Route::delete('/task/delete/{taskId}', [TaskController::class, 'destroy'])->name('delete_task');
