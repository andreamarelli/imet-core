<?php
/** @var string $phase */

?>
<div class="id" style="margin-bottom: 4px;">
    IMET #{{ $item->getKey() }}
    @if($item->version==='v1')
        &nbsp;<span class="badge badge-secondary" style="vertical-align: text-top;">v1</span>
    @elseif($item->version==='v2')
        &nbsp;<span class="badge badge-success" style="vertical-align: text-top;">v2</span>
    @endif

</div>

<div class="entity-heading">
    <div class="subtitle">{{ $item->Year }}</div>
    &nbsp;
    <div class="name">
        {!! \AndreaMarelli\ImetCore\Helpers\Template::flag($item->Country) !!}
        {{ $item->name }}
        @if(!\AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa::isNonWdpa( $item->wdpa_id))
            (<a target="_blank"
                href="{{ \AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet::WEBSITE_URL  }}/{{ $item->wdpa_id }}">{{ $item->wdpa_id }}</a>
            )
        @endif
    </div>
</div>

<nav class="steps">

    @if($item->version=='v1')

        <a href="{{ route('imet-core::v1_context_edit', [$item->getKey()]) }}"
           class="step @if('context'==$phase) selected @endif"
        >@lang_u('imet-core::common.context_long')</a>

        <a href="{{ route('imet-core::v1_eval_edit', [$item->getKey()]) }}"
           class="step @if('evaluation'==$phase) selected @endif"
        >@lang_u('imet-core::common.evaluation_long')</a>

        <a href="{{ route('imet-core::v1_report_update', [$item->getKey()]) }}"
           class="step @if('report'==$phase) selected @endif"
        >@lang_u('imet-core::common.report_long')</a>

    @else

        <a href="{{ route('imet-core::v2_context_edit', [$item->getKey()]) }}"
           class="step @if('context'==$phase) selected @endif"
        >@lang_u('imet-core::common.context_long')</a>

        <a href="{{ route('imet-core::v2_eval_edit', [$item->getKey()]) }}"
           class="step @if('evaluation'==$phase) selected @endif"
        >@lang_u('imet-core::common.evaluation_long')</a>

        <a href="{{ route('imet-core::v2_report_edit', [$item->getKey()]) }}"
           class="step @if('report'==$phase) selected @endif"
        >@lang_u('imet-core::common.report_long')</a>

    @endif

</nav>
