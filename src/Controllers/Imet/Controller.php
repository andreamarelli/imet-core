<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Controllers\__Controller;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Backup;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\ConvertSQLite;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\ImportExport;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Pame;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ModularForms\Helpers\File\Zip;
use AndreaMarelli\ModularForms\Helpers\File\File;
use AndreaMarelli\ModularForms\Helpers\HTTP;
use AndreaMarelli\ModularForms\Models\Traits\Upload;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function report;
use function response;
use function trans;
use function view;


class Controller extends __Controller
{
    use Pame;
    use Backup;
    use ConvertSQLite;
    use ImportExport;

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


    /**
     * Upload file
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function upload(Request $request): JsonResponse
    {
        $file = $request->file('file');
        $ext = $file->extension();
        $files = [];
        try {
            //upload file
            $uploaded = Upload::uploadFile($file);
            $import = new static();
            //and then check if is zip or json
            if (in_array($ext, ['zip'])) {
                $uploaded_path = Storage::disk(File::TEMP_STORAGE)->path( $uploaded['temp_filename']);
                $extractFiles = Zip::extract($uploaded_path);
                $num_extracted = 0;
                foreach ($extractFiles as $item) {
                    if(Str::endsWith($item, '.json') && $num_extracted < 10){
                        $json = json_decode(Upload::getUploadFileContent(['temp_filename' => $item]), true);
                        $files[] = $import->import(new Request(), $json, false);
                        Storage::disk(File::TEMP_STORAGE)->delete($item);
                        $num_extracted++;
                    }
                }
            } else {
                $json = json_decode(Upload::getUploadFileContent($uploaded), true);
                $files[] = $import->import(new Request(), $json, false);
                Storage::disk(File::TEMP_STORAGE)->delete($uploaded['temp_filename']);
            }

            if (count($files) === 0 || (count($files) === 1 && isset($files[0]) && $files[0]['status'] === 'error')) {
                return response()->json(["message" => trans('modular-forms::common.upload.no_files_found')], 500);
            }
        } catch (Exception $e) {
            report($e);
            return response()->json(["message" => $e->getMessage()], 500);
        }

        return response()->json($files);
    }

}
