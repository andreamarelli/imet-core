<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\v1;

use AndreaMarelli\ImetCore\Controllers\Imet\Controller as BaseController;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet;


class Controller extends BaseController
{
    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::v1.context';
    protected static $form_default_step = 'general_info';

}
