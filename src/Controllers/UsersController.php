<?php

namespace AndreaMarelli\ImetCore\Controllers;

use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \ImetUser as User;


class UsersController extends __Controller
{
    protected static $form_class = Role::class;
    protected static $form_view_prefix = 'imet-core::users/';

    public function index(Request $request, $role_type = null)
    {
        $this->authorize('manage', static::$form_class);

        $role_type = $role_type ?? Role::ROLE_ADMINISTRATOR;
        $users = User::where('imet_role', $role_type)
            ->with(['imet_roles', 'country'])
            ->get();

        return view(static::$form_view_prefix . $role_type, [
            'controller' => static::class,
            'role' => $role_type,
            'users_and_roles' => $users
        ]);
    }

    public function search(Request $request): JsonResponse
    {
        $list = $request->filled('search_key')
            ? User::searchByKey($request->input('search_key'))
            : collect();

        return response()->json([
            'records' => $list->toArray()
        ]);
    }

    public function update_roles(Request $request)
    {
        $this->authorize('manage', static::$form_class);

        $records = json_decode($request->input('records'), true);
        $role_type = $request->input('role_type');



        if($role_type == Role::ROLE_ADMINISTRATOR){
            foreach ($records as $record){
                if($record){
                    // Remove any eventual role and set user's imet_role
                    Role::where('user_id', $record['id'])->delete();
                    User::find($record['id'])->update(['imet_role' => Role::ROLE_ADMINISTRATOR]);
                }
            }
        }

        return [
            'status' => 'success'
        ];
    }

}
