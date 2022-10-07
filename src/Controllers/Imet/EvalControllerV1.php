<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Controllers\Imet\EvalController;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet_Eval;


class EvalControllerV1 extends EvalController
{

    protected static $form_class = Imet_Eval::class;
    protected static $form_view_prefix = 'imet-core::v1.evaluation';

    /**
     * Override show route
     *
     * @param $item
     * @param null $step
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($item, $step = null)
    {
        $this->authorize('view', (static::$form_class)::find($item));

        $form = new static::$form_class();
        $form = $form->find($item);
        $step = $step == null ? 'context' : $step;

        $steps = $this->steps($form);
        $key = array_search('cross_analysis', $steps);
        unset($steps[$key]);

        return view(static::$form_view_prefix . '.show', [
            'item' => $form,
            'steps' => $steps,
            'step' => $step
        ]);
    }
}
