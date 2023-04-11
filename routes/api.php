<?php

use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    // return $request->user();
    Route::get('/logged-in-user', [UserController::class, 'loggedInUser']);
    Route::get('/profiles/{id}', [ProfileController::class, 'show']);


});
Route::apiResource('contracts', ContractController::class);
