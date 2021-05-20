<?php
/** @var string $phase */

?>
<div class="id" style="margin-bottom: 4px;">IMET #{{ $item->getKey() }}</div>

<div class="entity-heading">
    <div class="subtitle">{{ $item->Year }}</div>
    &nbsp;
    <div class="name">
        {!! \AndreaMarelli\ModularForms\Helpers\Template::flag($item->Country) !!}
        {{ $item->name }}
        (<a target="_blank" href="{{ \AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet::WEBSITE_URL  }}/{{ $item->wdpa_id }}">{{ $item->wdpa_id }}</a>)
    </div>
</div>

<nav class="steps">

    <a href="{{ action([\AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class, 'edit'], [$item->getKey()]) }}"
       class="step @if('context'==$phase) selected @endif"
    >
        {{ ucfirst(trans('form/imet/common.context_long')) }}
    </a>

    <a href="{{ action([\AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV2::class, 'edit'], [$item->getKey()]) }}"
       class="step @if('evaluation'==$phase) selected @endif"
    >
        {{ ucfirst(trans('form/imet/common.evaluation_long')) }}
    </a>

    <a href="{{ action([\AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class, 'report'], [$item->getKey()]) }}"
       class="step @if('report'==$phase) selected @endif"
    >
        {{ ucfirst(trans('form/imet/common.report_long')) }}
    </a>

</nav>


{{-- <h3>{{ ucfirst(trans('form/imet/common.context_long')) }}</h3> --}}
