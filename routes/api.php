<?php

use App\Http\Controllers\Api\V1\ContractController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('contracts', ContractController::class);

    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::get('getAuthUser', [UserController::class, 'getAuthUser']);
});
