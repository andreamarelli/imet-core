<?php

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use AndreaMarelli\ImetCore\Controllers\Imet\ControllerV1;
use AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2;
use AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV1;
use AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV2;
use AndreaMarelli\ImetCore\Controllers\ProtectedAreaController;
use AndreaMarelli\ImetCore\Controllers\SpeciesController;
use AndreaMarelli\ImetCore\Controllers\StaffController;
use AndreaMarelli\ModularForms\Controllers\UploadFileController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'setLocale'], function () {

    if (is_imet_environment()) {

        Route::get('/', function () { return Redirect::to('admin/confirm_user'); });
        Route::get('welcome', function () { return Redirect::to('admin/confirm_user'); });
        Route::get('admin', function () { return Redirect::to('admin/confirm_user'); });

        Route::get('file/{hash}',      [UploadFileController::class, 'download']);

        Route::get('admin/imet/offline/close', function () { return view('admin.imet.offline.close'); });
        Route::get('admin/confirm_user', function () { return view('admin.imet.offline.confirm_user'); });
        Route::get('admin/offline_user', function () { return view('admin.imet.offline.edit_user'); });
        Route::patch('admin/staff/{item}', [StaffController::class, 'update_offline']);

        Route::group(['prefix' => 'ajax'], function () {
            Route::post('upload', [UploadFileController::class, 'upload']);
            Route::get('download', [UploadFileController::class, 'download']);
            Route::post('protected_areas/getLabels', [ProtectedAreaController::class, 'getLabels']);
            Route::group(['prefix' => 'search'], function () {
                Route::post('protected_areas', [ProtectedAreaController::class, 'search']);
                Route::post('species', [SpeciesController::class, 'search']);
            });
        });
    }


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
        Route::post('{item}/upgrade',      [Controller::class, 'upgrade']);


        // #### IMET Version 1 ####
        Route::group(['prefix' => 'v1'], function () {
            Route::group(['prefix' => 'context'], function () {
                Route::get('{item}/edit/{step?}', [ControllerV1::class, 'edit']);
                Route::patch('{item}',           [ControllerV1::class, 'update']);
            });
            Route::group(['prefix' => 'evaluation'], function () {
                Route::get('{item}/edit/{step?}', [EvalControllerV1::class, 'edit']);
                Route::patch('{item}',           [EvalControllerV1::class, 'update']);
            });
            Route::group(['prefix' => 'report'], function () {
                Route::get('{item}/edit', [ControllerV1::class, 'report']);
                Route::get('{item}/show', [ControllerV1::class, 'report_show']);
                Route::patch('{item}', [ControllerV1::class, 'report_update']);
            });
        });

        // #### IMET Version 2 ####
        Route::group(['prefix' => 'v2'], function () {
            Route::get('{item}/print',       [ControllerV2::class, 'print']);

            Route::group(['prefix' => 'context'], function () {
                Route::get('{item}/edit/{step?}',[ControllerV2::class, 'edit']);
                Route::get('{item}/show/{step?}',[ControllerV2::class, 'show']);
                Route::patch('{item}',           [ControllerV2::class, 'update']);
                Route::get('create',            [ControllerV2::class, 'create']);
                Route::post('store',            [ControllerV2::class, 'store']);
                Route::post('prev_years',            [ControllerV2::class, 'retrieve_prev_years']);
            });
            Route::group(['prefix' => 'evaluation'], function () {
                Route::get('{item}/edit/{step?}',   [EvalControllerV2::class, 'edit']);
                Route::get('{item}/show/{step?}',   [EvalControllerV2::class, 'show']);
                Route::get('{item}/print',          [EvalControllerV2::class, 'print']);
                Route::patch('{item}',           [EvalControllerV2::class, 'update']);
            });
            Route::group(['prefix' => 'report'], function () {
                Route::get('{item}/edit', [ControllerV2::class, 'report']);
                Route::get('{item}/show', [ControllerV2::class, 'report_show']);
                Route::patch('{item}', [ControllerV2::class, 'report_update']);
            });

        });

        Route::group(['prefix' => 'tools'], function () {
            Route::get('export_csv', [Controller::class, 'exportListCSV'])->name('csv_list');
            Route::get('export_csv/{ids}/{module_key}', [Controller::class, 'exportModuleToCsv'])->name('csv');
            Route::post('export_batch',        [Controller::class, 'export_batch'])->name('export_json_batch');
        });


    });

});

