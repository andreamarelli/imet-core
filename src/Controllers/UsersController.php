<?php

namespace AndreaMarelli\ImetCore\Controllers;

use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Http\Request;


class UsersController extends __Controller
{
    protected static $form_class = Role::class;
    protected static $form_view_prefix = 'imet-core::';

    public function index(Request $request)
    {
        $this->authorize('manage', static::$form_class);

        $roles = Role::all();

        return view(static::$form_view_prefix . 'users', [
            'controller' => static::class,
            'roles' => $roles
        ]);
    }

}