<?php

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use AndreaMarelli\ImetCore\Controllers\Imet\EvalController;
use AndreaMarelli\ImetCore\Controllers\Imet\v1;
use AndreaMarelli\ImetCore\Controllers\Imet\v2;
use AndreaMarelli\ImetCore\Controllers\ProtectedAreaController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['setLocale', 'web']], function () {

    Route::group(['prefix' => 'admin/imet', 'middleware' => 'auth'], function () {

        // ####  common routes (v1 & v2) ####
        Route::match(['get', 'post'],'/',      [Controller::class, 'index'])->name('index');
        Route::match(['get', 'post'],'v1',      [Controller::class, 'index']);     // temporary alias
        Route::match(['get', 'post'],'v2',      [Controller::class, 'index']);     // temporary alias
        Route::delete('{item}', [Controller::class, 'destroy']);
        Route::get('{item}/export', [Controller::class, 'export']);
        Route::match(['get','post'],'export_view',        [Controller::class, 'export_view'])->name('export_view');

        Route::post('ajax/upload', [Controller::class, 'upload']);
        Route::get('import',        [Controller::class, 'import_view']);
        Route::post('import',      [Controller::class, 'import']);
        Route::get('{item}/merge',  [Controller::class, 'merge_view']);
        Route::post('merge',      [Controller::class, 'merge']);

        // #### IMET Version 1 ####
        Route::group(['prefix' => 'v1'], function () {
            Route::group(['prefix' => 'context'], function () {
                Route::get('{item}/edit/{step?}', [v1\Controller::class, 'edit']);
                Route::patch('{item}',           [v1\Controller::class, 'update']);
            });
            Route::group(['prefix' => 'evaluation'], function () {
                Route::get('{item}/edit/{step?}', [v1\EvalController::class, 'edit']);
                Route::patch('{item}',           [v1\EvalController::class, 'update']);
            });
            Route::group(['prefix' => 'report'], function () {
                Route::get('{item}/edit', [v1\ReportController::class, 'report']);
                Route::get('{item}/show', [v1\ReportController::class, 'report_show']);
                Route::patch('{item}', [v1\ReportController::class, 'report_update']);
            });
        });

        // #### IMET Version 2 ####
        Route::group(['prefix' => 'v2'], function () {
            Route::get('{item}/print',       [v2\Controller::class, 'print']);

            Route::group(['prefix' => 'context'], function () {
                Route::get('{item}/edit/{step?}',[v2\Controller::class, 'edit']);
                Route::get('{item}/show/{step?}',[v2\Controller::class, 'show']);
                Route::patch('{item}',           [v2\Controller::class, 'update']);
                Route::get('create',            [v2\Controller::class, 'create']);
                Route::get('create_non_wdpa', [v2\Controller::class, 'create_non_wdpa']);
                Route::post('store',            [v2\Controller::class, 'store']);
                Route::post('prev_years',            [v2\Controller::class, 'retrieve_prev_years']);
            });
            Route::group(['prefix' => 'evaluation'], function () {
                Route::get('{item}/edit/{step?}',   [v2\EvalController::class, 'edit']);
                Route::get('{item}/show/{step?}',   [v2\EvalController::class, 'show']);
                Route::get('{item}/print',          [v2\EvalController::class, 'print']);
                Route::patch('{item}',           [v2\EvalController::class, 'update']);
            });
            Route::group(['prefix' => 'report'], function () {
                Route::get('{item}/edit', [v2\ReportController::class, 'report']);
                Route::get('{item}/show', [v2\ReportController::class, 'report_show']);
                Route::patch('{item}', [v2\ReportController::class, 'report_update']);
            });

        });

        Route::group(['prefix' => 'tools'], function () {
            Route::get('export_csv', [Controller::class, 'exportListCSV'])->name('csv_list');
            Route::get('export_csv/{ids}/{module_key}', [Controller::class, 'exportModuleToCsv'])->name('csv');
            Route::post('export_batch',        [Controller::class, 'export_batch'])->name('export_json_batch');
        });


    });

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'api'], function () {

        Route::match(['get', 'post'], 'protected_areas/pairs',         [ProtectedAreaController::class, 'get_pairs']);

        Route::group(['prefix' => 'imet'], function () {
            Route::match(['get', 'post'], '/', [Controller::class, 'pame']);
            Route::get('assessment/{item}/{step?}', [EvalController::class, 'assessment']);
        });

    });

});

