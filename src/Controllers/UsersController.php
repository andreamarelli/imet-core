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
            ->with(['imet_roles.country_obj', 'imet_roles.wdpa_obj'])
            ->get()
            ->map(function ($item){
                $role_isos = [];
                $role_wdpas = [];
                foreach($item['imet_roles'] as $r){
                    if($r['country']!==null){
                        $role_isos[] = $r['country'];
                    }
                    if($r['wdpa']!==null){
                        $role_wdpas[] = $r['wdpa'];
                    }
                }
                unset($item['imet_roles']);
                return [
                    'user' => $item,
                    'role_isos' => implode(',', $role_isos),
                    'role_wdpas' => implode(',', $role_wdpas)
                ];
            });



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
            $defined_users = [];
            foreach ($records as $record){
                if($record){
                    // Remove any eventual role and set user's imet_role
                    Role::where('user_id', $record['id'])->delete();
                    User::find($record['id'])->update(['imet_role' => $role_type]);
                    $defined_users[] = $record['id'];
                }
            }
            // Set imet_role to null for any user with the given role which is not in the provided list
            if(!empty($defined_users)){
                User::where('imet_role', $role_type)
                    ->whereNotIn('id', $defined_users)
                    ->update(['imet_role' => null]);
            }
        }

        return [
            'status' => 'success'
        ];
    }

}
