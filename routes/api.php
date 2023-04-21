<?php

use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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

Route::get('/home',             [HomeController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    // return $request->user();
    Route::get('/logged-in-user', [UserController::class, 'loggedInUser']);
    Route::get('/profiles/{id}', [ProfileController::class, 'show']);
    Route::patch('/update-user', [UserController::class, 'updateUser']);

    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
});
Route::apiResource('drafts', DraftController::class);

Route::apiResource('contracts', ContractController::class);
Route::get('/getContracts', [ContractController::class, 'index']);
Route::get('/posts', [PostController::class, 'index']);

Route::post('/update-user-image', [UserController::class, 'updateUserImage']);
