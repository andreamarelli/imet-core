<?php

use AndreaMarelli\ImetCore\Controllers\Imet;
use AndreaMarelli\ImetCore\Controllers\ProtectedAreaController;
use AndreaMarelli\ImetCore\Controllers\SpeciesController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'api'], function () {

    // For internal use ONLY (required by vue selectors)
    Route::group(['prefix' => 'search'], function () {
        Route::post('species', [SpeciesController::class, 'search'])->name('imet-core::search_species');
        Route::post('protected_areas', [ProtectedAreaController::class, 'search'])->name('imet-core::search_pas');
        Route::post('protected_areas_labels', [ProtectedAreaController::class, 'search'])->name('imet-core::labels_pas');
    });

    Route::group(['prefix' => 'imet'], function () {
        Route::match(['get', 'post'], '/', [Imet\Controller::class, 'pame']);
        Route::get('assessment/{item}/{step?}', [Imet\EvalController::class, 'assessment']);
    });

});