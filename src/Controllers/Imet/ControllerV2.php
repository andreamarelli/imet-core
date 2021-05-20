<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Controllers\Imet\ReportV2;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ModularForms\Helpers\File\File;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

use function view;


class ControllerV2 extends Controller
{
    use ReportV2;

    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::v2.context';
    protected static $form_default_step = 'general_info';

    public const AUTHORIZE_BY_POLICY = true;

    /**
     * Retrieve existing previous forms
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function retrieve_prev_years(Request $request): \Illuminate\Support\Collection
    {
        $wdpa_id = ProtectedArea::getByWdpa($request->input('wdpa_id'))->wdpa_id;
        return Imet::select(['FormID','Year','wdpa_id'])
            ->where('wdpa_id', $wdpa_id)
            ->where('version', 'v2')
            ->where('Year', '<', $request->input('year'))
            ->orderByDesc('Year')
            ->get()
            ->pluck('Year', 'FormID');
    }

    public function store(Request $request): array
    {
        $records = json_decode($request->input('records_json'), true);

        // Export previous existing form and save as new (if selected)
        $prev_year_selection = $records[0]['prev_year_selection'] ?? null;
        unset($records[0]['prev_year_selection']);
        $request->merge(['records_json' => json_encode($records)]);
        if($prev_year_selection!==null && $prev_year_selection!=='no_import'){
            return (new Controller)->store_prefilled($request, $prev_year_selection);
        }

        // Create new form
        return parent::store($request);
    }

    /**
     * Manage "pdf" route
     *
     * @param $item
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot
     */
    public function pdf($item): BinaryFileResponse
    {
        $this->authorize('view', (static::$form_class)::find($item));

        $form = new static::$form_class();
        $form = $form->find($item);
        $view = view(static::$form_view_prefix . 'print', [
            'item' => $form
        ]);
        return File::exportToPDF($form->filename('pdf'), $view);
    }

}
