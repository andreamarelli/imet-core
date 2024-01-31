<?php

use \AndreaMarelli\ImetCore\Controllers\Imet;
use \AndreaMarelli\ImetCore\Models;
use \AndreaMarelli\ImetCore\Models\User\Role;
use \Illuminate\Support\Str;

/** @var Imet\v2\ContextController|Imet\v1\ContextController|Imet\v1\EvalController|Imet\v2\EvalController $controller */
/** @var Models\Imet\v2\Imet|Models\Imet\v1\Imet|Models\Imet\oecm\Imet|Models\Imet\v2\Imet_Eval|Models\Imet\v1\Imet_Eval|Models\Imet\oecm\Imet_Eval $item */
/** @var string $step */
/** @var string $step_labels */

if(Str::contains($controller, 'ContextController')){
    $phase = 'context';
} else if(Str::contains($controller, 'EvalController')){
    $phase = 'evaluation';
}

$show_scrollbar = true;

?>

@extends('modular-forms::layouts.forms')

@section('content')

    {{--  Heading --}}
    @include('imet-core::components.heading', ['item' => $item])

    {{--  Phase  --}}
    @include('imet-core::components.phase', ['phase' => $phase])

    {{--  Steps menu --}}
    @include('modular-forms::page.components.steps', [
        'url' => action([$controller, 'show'], ['item' => $item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'imet-core::' . $step_labels . '.',
        'steps' => array_keys($item::modules())
    ])

    {{-- Cross Analysis --}}
    @if($step==='cross_analysis')
        @include('imet-core::v2.cross_analysis.index', [
            'item_id' => $item->getKey(),
            'warnings' => $warnings
        ])

    @else

        {{-- Management effectiveness --}}
        @if($step==='evaluation')
            @include('imet-core::v2.evaluation.management_effectiveness.management_effectiveness', [
                'item_id' => $item->getKey(),
                'step' => $step
            ])
        @endif

        {{--  Modules (by step) --}}
        <div class="imet_modules">
            @foreach($item::modules()[$step] as $module)
                @if(Role::hasRequiredAccessLevel($module))
                    <x-modular-forms::module.container
                            :controller="$controller"
                            :module="$module"
                            :formId="$item->getKey()"
                            :mode="\AndreaMarelli\ModularForms\View\Module\Container::MODE_SHOW"
                    ></x-modular-forms::module.container>
                @else
                    @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
                @endif
            @endforeach
        </div>

    @endif

    {{--  Scroll buttons  --}}
    @if($show_scrollbar)
        @include('modular-forms::module.scroll', ['item' => $item, 'step' => $step])
    @endif


@endsection