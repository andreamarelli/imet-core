<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

use \Wa72\HtmlPageDom\HtmlPageCrawler;

$view_table = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.table', compact(['collection', 'vueData', 'definitions']))->render();

$input = '<input type="text" disabled="disabled" v-model="stats[index]" class="field-disabled field-edit field-numeric text-center" />';

$dom = HtmlPageCrawler::create(
    \Wa72\HtmlPageDom\Helpers::trimNewlines($view_table)
);
$dom->filter('thead > tr > th')->eq(0)->append('<th></th>');
$dom->filter('tbody > tr.module-table-item td')->eq(0)->append('<td>'.$input.'</td>');

$vueData['stats'] =  \AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\MenacesPressions::getStats($vueData['form_id'])['category_stats'];


?>


{!! $dom->saveHTML() !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@include('modular-forms::module.edit.script', compact(['collection', 'vueData', 'definitions']))
