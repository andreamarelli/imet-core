<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\v2;

use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use Illuminate\Http\Request;

class ContextController extends Controller
{
    protected static $form_view_prefix = 'imet-core::v2.context';
    protected static $form_default_step = 'general_info';

}
