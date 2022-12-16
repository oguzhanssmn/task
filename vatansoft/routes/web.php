<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/noaccess', function(){
    return "Bu sayfaya erişiminiz yok";
});

Route::get('/banned', function(){
    return "İzinsiz denemelerden dolayı banlandınız";
});


Route::group(['middleware' => 'protectedPage', 'prefix' => 'user'], function () {

    Route::get('/list', [UserController::class, 'list']);
    Route::post('/insert', [UserController::class, 'insert']);
    Route::put('/update/{user}', [UserController::class, 'update']);
    Route::delete('/delete/{user}', [UserController::class, 'delete']);
    Route::delete('/destroy/{user}', [UserController::class, 'destroy']);
});
