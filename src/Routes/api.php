<?php

use AndreaMarelli\ImetCore\Controllers\ProtectedAreaController;
use AndreaMarelli\ImetCore\Controllers\SpeciesController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'api'], function () {

    // For internal use ONLY (required by vue selectors)
    Route::group(['prefix' => 'search'], function () {
        Route::post('protected_areas', [ProtectedAreaController::class, 'search'])->name('search_pas');
        Route::post('species', [SpeciesController::class, 'search'])->name('search_species');
    });

});