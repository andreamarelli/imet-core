<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use ImetCore\Models\Imet\v2\Modules\Evaluation\BoundaryLevel;
use Illuminate\Support\Facades\View;


$view = View::make('modular-forms::module.show.type.table', compact(['definitions', 'records']))->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteria(ImetModule::MARINE, $view, BoundaryLevel::get_marine_predefined());

?>

@include('modular-forms::module.show.type.commons', compact(['definitions', 'records']))
<br />
{!! $view !!}
