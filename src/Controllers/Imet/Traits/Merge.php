<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\Traits;

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use function redirect;


trait Merge
{
    /**
     * Open the merge tool view
     * @param $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function merge_view($item)
    {
        $form = Imet::find($item);

        return view(static::$form_view_prefix . 'merge.list', [
            'primary_form' => $form,
            'duplicated_forms' => $form->getDuplicates()
        ]);
    }

    /**
     * Execute th merge of the given module
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function merge(Request $request): RedirectResponse
    {
        /** @var \AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Component\ImetModule|\AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule $module_class */
        $module_class = $request->input('module');
        $source_form_id = $request->input('source_form');
        $destination_form_id = $request->input('destination_form');

        $records = $module_class::exportModule($source_form_id);
        $records = array_map(function ($item) use ($module_class, $destination_form_id) {
            $item[(new $module_class())->getKeyName()] = null;
            $item[$module_class::$foreign_key] = $destination_form_id;
            return $item;
        }, $records);

        $request = new Request();
        $request->merge(['records_json' => json_encode($records)]);
        $request->merge(['form_id' => $destination_form_id]);

        $module_class::updateModule($request);

        return redirect()->action([Controller::class, 'merge_view'], ['item' => $destination_form_id]);
    }
}