<?php

use AndreaMarelli\ImetCore\Controllers\DevStatisticsController;
use AndreaMarelli\ImetCore\Controllers\DevUsersController;
use AndreaMarelli\ImetCore\Controllers\Imet;
use AndreaMarelli\ImetCore\Controllers\Imet\OECM;
use AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpAnalysisController;
use AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpBasketController;
use AndreaMarelli\ImetCore\Controllers\Imet\v1;
use AndreaMarelli\ImetCore\Controllers\Imet\v2;
use AndreaMarelli\ImetCore\Controllers\ProtectedAreaController;
use AndreaMarelli\ImetCore\Controllers\SpeciesController;
use AndreaMarelli\ImetCore\Controllers\UsersController;
use Illuminate\Support\Facades\App;


use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['setLocale', 'web']], function () {

    /*
    |--------------------------------------------------------------------------
    | IMET v1 & v2 Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'admin/imet', 'middleware' => 'auth'], function () {

        // ####  common routes (v1 & v2) ####
        Route::match(['get', 'post'],'/',      [Imet\Controller::class, 'index'])->name('imet-core::index');
        Route::delete('{item}', [Imet\Controller::class, 'destroy']);
        Route::get('{item}/export', [Imet\Controller::class, 'export']);

        Route::post('ajax/upload', [Imet\Controller::class, 'upload'])->name('imet-core::upload_json');
        Route::match(['get','post'],'export_view',        [Imet\Controller::class, 'export_view'])->name('imet-core::export_view');
        Route::get('import',        [Imet\Controller::class, 'import_view'])->name('imet-core::import_view');
        Route::post('import',      [Imet\Controller::class, 'import'])->name('imet-core::import');
        Route::get('{item}/merge',  [Imet\Controller::class, 'merge_view'])->name('imet-core::merge_view');
        Route::post('merge',      [Imet\Controller::class, 'merge'])->name('merge');

        // #### IMET Version 1 ####
        Route::group(['prefix' => 'v1'], function () {

            Route::match(['get', 'post'],'/',      [Imet\Controller::class, 'index']);     // alias
            Route::get('{item}/print',       [v1\Controller::class, 'print']);

            Route::group(['prefix' => 'context'], function () {
                Route::get('{item}/show/{step?}', [v1\Controller::class, 'show'])->name('imet-core::v1_context_show');
                Route::get('{item}/edit/{step?}', [v1\Controller::class, 'edit'])->name('imet-core::v1_context_edit');
                Route::patch('{item}',           [v1\Controller::class, 'update']);
            });
            Route::group(['prefix' => 'evaluation'], function () {
                Route::get('{item}/show/{step?}', [v1\EvalController::class, 'show'])->name('imet-core::v1_eval_show');
                Route::get('{item}/edit/{step?}', [v1\EvalController::class, 'edit'])->name('imet-core::v1_eval_edit');
                Route::patch('{item}',           [v1\EvalController::class, 'update']);
            });
            Route::group(['prefix' => 'report'], function () {
                Route::get('{item}/edit', [v1\ReportController::class, 'report'])->name('imet-core::v1_report_edit');
                Route::get('{item}/show', [v1\ReportController::class, 'report_show'])->name('imet-core::v1_report_show');
                Route::patch('{item}', [v1\ReportController::class, 'report_update'])->name('imet-core::v1_report_update');
            });
        });

        // #### IMET Version 2 ####
        Route::group(['prefix' => 'v2'], function () {

            Route::match(['get', 'post'],'/',      [Imet\Controller::class, 'index']);     // alias
            Route::get('{item}/print',       [v2\Controller::class, 'print']);

            Route::group(['prefix' => 'context'], function () {
                Route::get('{item}/edit/{step?}',[v2\Controller::class, 'edit'])->name('imet-core::v2_context_edit');
                Route::get('{item}/show/{step?}',[v2\Controller::class, 'show'])->name('imet-core::v2_context_show');
                Route::patch('{item}',           [v2\Controller::class, 'update']);
                Route::get('create',            [v2\Controller::class, 'create'])->name('imet-core::v2.create');
                Route::get('create_non_wdpa', [v2\Controller::class, 'create_non_wdpa'])->name('imet-core::v2.create_non_wdpa');
                Route::post('store',            [v2\Controller::class, 'store']);
                Route::post('prev_years',            [v2\Controller::class, 'retrieve_prev_years'])->name('imet-core::retrieve_prev_years');
            });
            Route::group(['prefix' => 'evaluation'], function () {
                Route::get('{item}/edit/{step?}',   [v2\EvalController::class, 'edit'])->name('imet-core::v2_eval_edit');
                Route::get('{item}/show/{step?}',   [v2\EvalController::class, 'show'])->name('imet-core::v2_eval_show');
                Route::get('{item}/print',          [v2\EvalController::class, 'print']);
                Route::patch('{item}',           [v2\EvalController::class, 'update']);
            });
            Route::group(['prefix' => 'report'], function () {
                Route::get('{item}/edit', [v2\ReportController::class, 'report'])->name('imet-core::v2_report_edit');
                Route::get('{item}/show', [v2\ReportController::class, 'report_show'])->name('imet-core::v2_report_show');
                Route::patch('{item}', [v2\ReportController::class, 'report_update'])->name('imet-core::v2_report_update');
            });

        });

        // #### Scaling Up Analysis ####
        Route::group(['prefix' => 'scaling_up'], function () {

            Route::match(['get', 'post'],'/', [ScalingUpAnalysisController::class, 'index'])->name('imet-core::scaling_up_index');
            Route::post('analysis',     [ScalingUpAnalysisController::class, 'analysis'])->name('imet-core::scaling_up_analysis');
            Route::match(['get', 'post'],'/{items}', [ScalingUpAnalysisController::class, 'report'])->name('imet-core::scaling_up_report');
            Route::get('download/{scaling_id}', [ScalingUpAnalysisController::class, 'download_zip_file'])->name('imet-core::scaling_up_download');
            Route::get('preview/{id}',[ScalingUpAnalysisController::class, 'preview_template'])->name('imet-core::scaling_up_preview');


            Route::group(['prefix' => 'basket'], function () {
                Route::post('add',   [ScalingUpBasketController::class, 'save'])->name('imet-core::scaling_up_basket_add');
                Route::post('get',   [ScalingUpBasketController::class, 'retrieve'])->name('imet-core::scaling_up_basket_get');
                Route::post('all',   [ScalingUpBasketController::class, 'all'])->name('imet-core::scaling_up_basket_all');
                Route::delete('delete/{id}',[ScalingUpBasketController::class, 'delete'])->name('imet-core::scaling_up_basket_delete');
                Route::post('clear', [ScalingUpBasketController::class, 'clear'])->name('imet-core::scaling_up_basket_clear');
            });

        });


        Route::group(['prefix' => 'tools'], function () {
            Route::get('export_csv', [Imet\Controller::class, 'exportListCSV'])->name('imet-core::csv_list');
            Route::get('export_csv/{ids}/{module_key}', [Imet\Controller::class, 'exportModuleToCsv'])->name('imet-core::csv');
            Route::post('export_batch',        [Imet\Controller::class, 'export_batch'])->name('imet-core::export_json_batch');
        });

        /*
        |--------------------------------------------------------------------------
        | API Routes - for internal use ONLY
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {

            Route::post('species', [SpeciesController::class, 'search'])->name('imet-core::search_species');
            Route::post('protected_areas', [ProtectedAreaController::class, 'search'])->name('imet-core::search_pas');
            Route::post('protected_areas_labels', [ProtectedAreaController::class, 'get_pairs'])->name('imet-core::labels_pas');
            Route::post('users', [UsersController::class, 'search'])->name('imet-core::search_users');

        });

    });


    /*
    |--------------------------------------------------------------------------
    | IMET OECM Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'admin/imet/oecm', 'middleware' => 'auth'], function () {

        Route::match(['get', 'post'],'/',      [OECM\Controller::class, 'index'])->name('imet-core::oecm.index');
        Route::delete('{item}', [OECM\Controller::class, 'destroy']);

        Route::group(['prefix' => 'context'], function () {
            Route::get('create',            [OECM\Controller::class, 'create'])->name('imet-core::oecm_create');
            Route::get('create_non_wdpa', [OECM\Controller::class, 'create_non_wdpa'])->name('imet-core::oecm_create_non_wdpa');
        });

        Route::group(['prefix' => 'evaluation'], function () {

        });

        Route::group(['prefix' => 'report'], function () {

        });
        
    });

    /*
    |--------------------------------------------------------------------------
    | Management Routes
    |--------------------------------------------------------------------------
    */
    Route::get('users/{role_type?}', [UsersController::class, 'index'])->name('imet-core::users');
    Route::patch('users', [UsersController::class, 'update_roles'])->name('imet-core::users_update');


    /*
    |--------------------------------------------------------------------------
    | Development Routes
    |--------------------------------------------------------------------------
    */
    if(App::environment('imetglobal_dev')) {

        Route::get('create_dev_users', [DevUsersController::class, 'create_dev_users'])->name('imet-core::create_dev_users');
        Route::post('change_user', [DevUsersController::class, 'change_user'])->name('imet-core::change_user');

    }

    Route::get('stats_in_php', [DevStatisticsController::class, 'index']);

});

