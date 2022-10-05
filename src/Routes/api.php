<?php

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use AndreaMarelli\ImetCore\Controllers\Imet\EvalController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api'], function () {

    Route::group(['prefix' => 'imet'], function () {

        Route::match(['get', 'post'], '/', [Controller::class, 'pame']);
        Route::get('assessment/{item}/{step?}', [EvalController::class, 'assessment'])->name('imet_core::api::assessment');

    });

});
