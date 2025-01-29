<?php

use AndreaMarelli\ImetCore\Controllers\Imet;
use AndreaMarelli\ImetCore\Controllers\Imet\oecm;
use AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpAnalysisController;
use AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpBasketController;
use AndreaMarelli\ImetCore\Controllers\Imet\v1;
use AndreaMarelli\ImetCore\Controllers\Imet\v2;
use AndreaMarelli\ImetCore\Controllers\ProtectedAreaController;
use AndreaMarelli\ImetCore\Controllers\SpeciesController;
use AndreaMarelli\ImetCore\Controllers\UsersController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['setLocale', 'web']], function () {

    // Old routes: to be kept for the moment rto ensure backwards compatibility
    Route::get('/{url}', function ($url) {
        return Redirect::to('imet/');
    })->where(['url' => 'admin/imet|admin/imet/v1|admin/imet/v2']);
    Route::get('/{url}', function ($url) {
        return Redirect::to('oecm/');
    })->where(['url' => 'admin/oecm']);

    /*
    |--------------------------------------------------------------------------
    | IMET Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'imet', 'middleware' => 'auth'], function (){

        // ####  common routes (v1 & v2) ####
        Route::get('import',        [Imet\Controller::class, 'import_view'])->name(Imet\Controller::ROUTE_PREFIX.'import_view');
        Route::post('import',      [Imet\Controller::class, 'import'])->name(Imet\Controller::ROUTE_PREFIX.'import');
        Route::post('ajax/upload', [Imet\Controller::class, 'upload'])->name(Imet\Controller::ROUTE_PREFIX.'upload_json');
        Route::match(['get', 'post'],'/',      [Imet\Controller::class, 'index'])->name(Imet\Controller::ROUTE_PREFIX.'index');


        // #### IMET Version 1 ####
        Route::group(['prefix' => 'v1'], function () {

            Route::match(['get', 'post'],'/',      [Imet\Controller::class, 'index'])->name(v1\Controller::ROUTE_PREFIX.'index');     // alias

            // import/export
            Route::match(['get','post'],'export_view',        [v1\Controller::class, 'export_view'])->name(v1\Controller::ROUTE_PREFIX.'export_view');
            Route::get('{item}/print',  [v1\Controller::class, 'print']);
            Route::get('{item}/export', [v1\Controller::class, 'export']);
            Route::get('{item}/export_no_attachments', [v1\Controller::class, 'export_no_attachments']);
            Route::post('export_batch',        [v1\Controller::class, 'export_batch'])->name(v1\Controller::ROUTE_PREFIX.'export_batch');
            Route::get('import',        [Imet\Controller::class, 'import_view'])->name(v1\Controller::ROUTE_PREFIX.'import_view');    // alias
            Route::post('import',      [Imet\Controller::class, 'import'])->name(v1\Controller::ROUTE_PREFIX.'import');    // alias
            Route::post('ajax/upload', [Imet\Controller::class, 'upload'])->name(v1\Controller::ROUTE_PREFIX.'upload_json');    // alias

            // merge
            Route::get('{item}/merge',  [v1\Controller::class, 'merge_view'])->name(v1\Controller::ROUTE_PREFIX.'merge_view');
            Route::post('merge',      [v1\Controller::class, 'merge'])->name(v1\Controller::ROUTE_PREFIX.'merge');

            // create/destroy
            Route::delete('{item}',     [v1\Controller::class, 'destroy']);

            // edit/show
            Route::group(['prefix' => 'context'], function () {
                Route::get('{item}/show/{step?}',   [v1\ContextController::class, 'show'])->name(v1\Controller::ROUTE_PREFIX.'context_show');
                Route::get('{item}/edit/{step?}',   [v1\ContextController::class, 'edit'])->name(v1\Controller::ROUTE_PREFIX.'context_edit');
                Route::patch('{item}',              [v1\ContextController::class, 'update']);
            });
            Route::group(['prefix' => 'evaluation'], function () {
                Route::get('{item}/show/{step?}',   [v1\EvalController::class, 'show'])->name(v1\Controller::ROUTE_PREFIX.'eval_show');
                Route::get('{item}/edit/{step?}',   [v1\EvalController::class, 'edit'])->name(v1\Controller::ROUTE_PREFIX.'eval_edit');
                Route::patch('{item}',              [v1\EvalController::class, 'update']);
            });
            Route::group(['prefix' => 'report'], function () {
                Route::get('{item}/edit',   [v1\ReportController::class, 'report'])->name(v1\Controller::ROUTE_PREFIX.'report_edit');
                Route::get('{item}/show',   [v1\ReportController::class, 'report_show'])->name(v1\Controller::ROUTE_PREFIX.'report_show');
                Route::patch('{item}',      [v1\ReportController::class, 'report_update'])->name(v1\Controller::ROUTE_PREFIX.'report_update');
            });
        });

        // #### IMET Version 2 ####
        Route::group(['prefix' => 'v2'], function () {

            Route::match(['get', 'post'],'/',[Imet\Controller::class, 'index'])->name(v2\Controller::ROUTE_PREFIX.'index');    // alias

            // import/export
            Route::match(['get','post'],'export_view',        [v2\Controller::class, 'export_view'])->name(v2\Controller::ROUTE_PREFIX.'export_view');
            Route::get('{item}/print',       [v2\Controller::class, 'print']);
            Route::get('{item}/export', [v2\Controller::class, 'export']);
            Route::get('{item}/export_no_attachments', [v2\Controller::class, 'export_no_attachments']);
            Route::post('export_batch',        [v2\Controller::class, 'export_batch'])->name(v2\Controller::ROUTE_PREFIX.'export_batch');
            Route::get('import',        [Imet\Controller::class, 'import_view'])->name(v2\Controller::ROUTE_PREFIX.'import_view');    // alias
            Route::post('import',      [Imet\Controller::class, 'import'])->name(v2\Controller::ROUTE_PREFIX.'import');    // alias
            Route::post('ajax/upload', [Imet\Controller::class, 'upload'])->name(v2\Controller::ROUTE_PREFIX.'upload_json');    // alias

            // merge
            Route::get('{item}/merge',  [v2\Controller::class, 'merge_view'])->name(v2\Controller::ROUTE_PREFIX.'merge_view');
            Route::post('merge',      [v2\Controller::class, 'merge'])->name(v2\Controller::ROUTE_PREFIX.'merge');

            // create/destroy
            Route::delete('{item}',     [v2\Controller::class, 'destroy']);
            Route::get('create',        [v2\Controller::class, 'create'])->name(v2\Controller::ROUTE_PREFIX.'create');
            Route::get('create_non_wdpa',[v2\Controller::class, 'create_non_wdpa'])->name(v2\Controller::ROUTE_PREFIX.'create_non_wdpa');
            Route::post('store',        [v2\ContextController::class, 'store']);
            Route::post('prev_years',   [v2\Controller::class, 'retrieve_prev_years'])->name(v2\Controller::ROUTE_PREFIX.'retrieve_prev_years');

            // edit/show
            Route::group(['prefix' => 'context'], function () {
                Route::get('{item}/edit/{step?}',[v2\ContextController::class, 'edit'])->name(v2\Controller::ROUTE_PREFIX.'context_edit');
                Route::get('{item}/show/{step?}',[v2\ContextController::class, 'show'])->name(v2\Controller::ROUTE_PREFIX.'context_show');
                Route::patch('{item}',           [v2\ContextController::class, 'update']);
            });
            Route::group(['prefix' => 'evaluation'], function () {
                Route::get('{item}/edit/{step?}',[v2\EvalController::class, 'edit'])->name(v2\Controller::ROUTE_PREFIX.'eval_edit');
                Route::get('{item}/show/{step?}',[v2\EvalController::class, 'show'])->name(v2\Controller::ROUTE_PREFIX.'eval_show');
                Route::get('{item}/print',       [v2\EvalController::class, 'print']);
                Route::patch('{item}',           [v2\EvalController::class, 'update']);
            });
            Route::group(['prefix' => 'report'], function () {
                Route::get('{item}/edit',   [v2\ReportController::class, 'report'])->name(v2\Controller::ROUTE_PREFIX.'report_edit');
                Route::get('{item}/show',   [v2\ReportController::class, 'report_show'])->name(v2\Controller::ROUTE_PREFIX.'report_show');
                Route::patch('{item}',      [v2\ReportController::class, 'report_update'])->name(v2\Controller::ROUTE_PREFIX.'report_update');
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
    Route::group(['prefix' => 'oecm', 'middleware' => 'auth'], function () {

        Route::match(['get', 'post'],'/',[oecm\Controller::class, 'index'])->name(oecm\Controller::ROUTE_PREFIX.'index');

        Route::delete('{item}',         [oecm\Controller::class, 'destroy']);
        Route::get('{item}/print',      [oecm\Controller::class, 'print']);
        Route::get('{item}/export',     [oecm\Controller::class, 'export']);
        Route::get('{item}/export_no_attachments', [oecm\Controller::class, 'export_no_attachments']);
        Route::match(['get','post'],'export_view',        [oecm\Controller::class, 'export_view'])->name(oecm\Controller::ROUTE_PREFIX.'export_view');
        Route::post('export_batch',        [oecm\Controller::class, 'export_batch'])->name(oecm\Controller::ROUTE_PREFIX.'export_batch');
        Route::get('{item}/merge',  [oecm\Controller::class, 'merge_view'])->name(oecm\Controller::ROUTE_PREFIX.'merge_view');
        Route::post('merge',      [oecm\Controller::class, 'merge'])->name(oecm\Controller::ROUTE_PREFIX.'merge');
        Route::get('import',        [oecm\Controller::class, 'import_view'])->name(oecm\Controller::ROUTE_PREFIX.'import_view');
        Route::post('import',      [oecm\Controller::class, 'import'])->name(oecm\Controller::ROUTE_PREFIX.'import');
        Route::post('ajax/upload', [oecm\Controller::class, 'upload'])->name(oecm\Controller::ROUTE_PREFIX.'upload_json');

        Route::get('create',            [oecm\Controller::class, 'create'])->name(oecm\Controller::ROUTE_PREFIX.'create');
        Route::get('create_non_wdpa',   [oecm\Controller::class, 'create_non_wdpa'])->name(oecm\Controller::ROUTE_PREFIX.'create_non_wdpa');
        Route::post('store',            [oecm\ContextController::class, 'store']);
        Route::post('prev_years',       [oecm\Controller::class, 'retrieve_prev_years'])->name(oecm\Controller::ROUTE_PREFIX.'retrieve_prev_years');

        Route::group(['prefix' => 'context'], function () {
            Route::get('{item}/edit/{step?}',[oecm\ContextController::class, 'edit'])->name(oecm\Controller::ROUTE_PREFIX.'context_edit');
            Route::get('{item}/show/{step?}',[oecm\ContextController::class, 'show'])->name(oecm\Controller::ROUTE_PREFIX.'context_show');
            Route::patch('{item}',           [oecm\ContextController::class, 'update']);
            Route::get('{item}/print_sa',           [oecm\ContextController::class, 'print_sa'])->name(oecm\Controller::ROUTE_PREFIX.'print_sa');
        });
        Route::group(['prefix' => 'evaluation'], function () {
            Route::get('{item}/edit/{step?}',   [oecm\EvalController::class, 'edit'])->name(oecm\Controller::ROUTE_PREFIX.'eval_edit');
            Route::get('{item}/show/{step?}',   [oecm\EvalController::class, 'show'])->name(oecm\Controller::ROUTE_PREFIX.'eval_show');
            Route::get('{item}/print',          [oecm\EvalController::class, 'print']);
            Route::patch('{item}',              [oecm\EvalController::class, 'update']);
        });
        Route::group(['prefix' => 'report'], function () {
            Route::get('{item}/edit',   [oecm\ReportController::class, 'report'])->name(oecm\Controller::ROUTE_PREFIX.'report_edit');
            Route::get('{item}/show',   [oecm\ReportController::class, 'report_show'])->name(oecm\Controller::ROUTE_PREFIX.'report_show');
            Route::patch('{item}',      [oecm\ReportController::class, 'report_update'])->name(oecm\Controller::ROUTE_PREFIX.'report_update');
            Route::get('objectives/{form_id}',      [oecm\ReportController::class, 'get_objectives'])->name(oecm\Controller::ROUTE_PREFIX.'report_objectives');
        });

    });

});

