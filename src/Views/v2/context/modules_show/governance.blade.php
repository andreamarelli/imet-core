<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */
?>

<h3>@lang('form/imet/v2/context.Governance.governance')</h3>
@include('modular-forms::module.show.type.commons', compact(['definitions', 'records']))

<h3>@lang('form/imet/v2/context.Governance.partnership')</h3>
@include('modular-forms::module.show.type.accordion', compact(['definitions', 'records']))
