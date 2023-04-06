<?php

use App\Http\Controllers\Api\V1\ContractController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1'], function () {
    // Route::apiResource('contracts', ContractController::class);
    // Route::get('logged-in-user', [UserController::class, 'loggedInUser']);

});
Route::post('registerr', [UserController::class, 'register']);
Route::post('loginn', [UserController::class, 'login']);
Route::apiResource('contracts', ContractController::class);
Route::get('logged-in-user', [UserController::class, 'loggedInUser']);

