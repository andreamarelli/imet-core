<?php
$url = '';
$method = 'POST';
$url = route('report_scaling_up', ['items' => $pa_ids]);
$expanded =  false;
$title =  trans('imet-core::analysis_report.custom_names');

?>

<div class="accordion" id="accordion-filters" style="margin-bottom: 40px;">
    @component('modular-forms::page.accordion', [
                'accordion_group_id' => 'accordion-filters',
                'accordion_id' => 'accordion-filters-1',
                'accordion_title' => $title,
                'expanded' => $expanded,
            ])

        @slot('accordion_content')
            <form class="form-horizontal form-filters" method="{{ $method }}" action="{{ $url }}">
                {{ csrf_field() }}

                <div class="form-grid">
                    @foreach($pas as $key => $pa)
                        {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::label('name', $pa->name) !!}
                        {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::text($pa->FormID  , $custom_names[$pa->FormID] )!!}
                    @endforeach
                </div>

                <div class="text-right">
                    <button type="submit" class="btn-nav rounded">@lang_u('imet-core::analysis_report.apply')</button>
                </div>

            </form>
        @endslot

    @endcomponent
</div>
