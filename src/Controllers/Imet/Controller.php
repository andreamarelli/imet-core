<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Controllers\__Controller;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Backup;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\ConvertSQLite;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\ImportExportJSON;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Merge;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Pame;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ModularForms\Helpers\HTTP;
use Illuminate\Http\Request;

use function view;


class Controller extends __Controller
{
    use Backup;
    use ConvertSQLite;
    use ImportExportJSON;
    use Merge;
    use Pame;

    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::';

    protected const PAGINATE = false;

    public const sanitization_rules = [
        'search' => 'custom_text|nullable',
        'year' => 'digits:4|integer|nullable',
        'country' => 'min:3|max:3|alpha|nullable',
    ];

    /**
     * Override index route
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', static::$form_class);
        HTTP::sanitize($request, self::sanitization_rules);

        // Check and add missing Pa data to form DB record
        Imet::checkMissingPaData();

        // set filter status
        $filter_selected = !empty(array_filter($request->except('_token')));

        // retrieve IMET list
        $filtered_list = Imet::get_list($request);
        $full_list = Imet::get_list(new Request());
        $years = array_values($full_list->pluck('Year')->sort()->unique()->toArray());
        $countries = ProtectedArea::getCountries()->pluck('name', 'iso3')->sort()->unique()->toArray();

        return view(static::$form_view_prefix . 'list', [
            'controller' => static::class,
            'list' => $filtered_list,
            'request' => $request,
            'filter_selected' => $filter_selected,
            'countries' => $countries,
            'years' => $years
        ]);
    }

    /**
     * Index route for scaling up
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function scaling_up(Request $request)
    {
        $this->authorize('viewAny', static::$form_class);
        HTTP::sanitize($request, self::sanitization_rules);

        // set filter status
        $filter_selected = !empty(array_filter($request->except('_token')));

        // retrieve IMET list
        $filtered_list = Imet::get_list($request);
        $full_list = Imet::get_list(new Request());
        $years = array_values($full_list->pluck('Year')->sort()->unique()->toArray());
        $countries = ProtectedArea::getCountries()->pluck('name', 'iso3')->sort()->unique()->toArray();

        return view(static::$form_view_prefix . 'scaling_up.list', [
            'controller' => static::class,
            'list' => $filtered_list,
            'request' => $request,
            'filter_selected' => $filter_selected,
            'countries' => $countries,
            'years' => $years
        ]);
    }

}
