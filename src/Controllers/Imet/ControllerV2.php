<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Controllers\Imet\ReportControllerV2;
use AndreaMarelli\ImetCore\Models\Encoder;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet_Eval;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ModularForms\Helpers\File\File;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

use function view;


class ControllerV2 extends Controller
{

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

    public function store_prefilled(Request $request, $prev_year_selection)
    {
        $records = json_decode($request->input('records_json'), true);

        $json = static::export(Imet::find($prev_year_selection), false);
        $json['Imet']['Year'] = $records[0]['Year'];
        $json['Imet']['UpdateDate'] = Carbon::now()->format('Y-m-d H:i:s');

        DB::beginTransaction();

        try {
            // Create new form and return ID
            $formID = Imet::importForm($json['Imet']);
            // Populate Imet & Imet_Eval modules
            Imet::importModules($json['Context'], $formID);
            Imet_Eval::importModules($json['Evaluation'], $formID);
            Encoder::importModule($formID, $json['Encoders'] ?? null);

            DB::commit();
            Session::flash('message', trans('common.saved_successfully'));
            return [
                'status' => 'success',
                'entity_label' => Imet::find($formID)->{Imet::LABEL},
                'edit_url' => action([static::class, 'edit'], ['item' => $formID])

            ];
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('message', trans('common.saved_error'));
            throw $e;
        }
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
