<?php

namespace ImetCore\Controllers\Imet\v2;

use ImetCore\Controllers\Imet\EvalController as BaseEvalController;
use ImetCore\Models\Imet\CrossAnalysis\CrossAnalysis;
use ImetCore\Models\Imet\v2\Imet_Eval;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

use function view;


class EvalController extends BaseEvalController
{
    protected static $form_class = Imet_Eval::class;
    protected static $form_view_prefix = 'imet-core::v2.evaluation';

    /**
     * add extra step for cross analysis before the last one
     *
     * @param $form
     * @return array
     */
    public static function steps($form): array
    {
        $steps = array_keys($form->modules());
        $last_step = array_splice($steps, -1);
        return array_merge($steps, ['cross_analysis'], $last_step);
    }


    /**
     * return if any discrepancies are found for cross analysis
     * and also the classes to be used for indication in the menu
     *
     * @param $form
     * @return array
     */
    protected function get_cross_analysis($form): array
    {
        $classes = [];
        $warnings = CrossAnalysis::getIndicators($form);
        if (count($warnings) > 0) {
            $classes['cross_analysis'] = 'cross-analysis-warnings';
        }
        return [$warnings, $classes];
    }

    /**
     * Override edit route
     *
     * @throws AuthorizationException
     */
    public function edit($item, $step = null): Application|View|Factory
    {
        $imet = (static::$form_class)::find($item);
        $this->authorize('view', $imet);

        $step = $step == null ? 'context' : $step;
        list($warnings, $classes) = $this->get_cross_analysis($imet);

        return view(static::$form_view_prefix . '.edit', [
            'controller' => static::class,
            'item' => $imet,
            'step' => $step,
            'warnings' => $warnings,
            'classes' => $classes
        ]);
    }

    /**
     * Override show route
     *
     * @throws AuthorizationException
     */
    public function show($item, $step = null): Application|View|Factory
    {
        $imet = (static::$form_class)::find($item);
        $this->authorize('view', $imet);

        $step = $step == null ? 'context' : $step;
        list($warnings, $classes) = $this->get_cross_analysis($imet);

        return view(static::$form_view_prefix . '.show', [
            'controller' => static::class,
            'item' => $imet,
            'step' => $step,
            'warnings' => $warnings,
            'classes' => $classes
        ]);
    }

}
