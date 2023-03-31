<?php

use App\Http\Controllers\Api\V1\ContractController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
    Route::apiResource('contracts', ContractController::class);
});
