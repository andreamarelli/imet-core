<?php

namespace AndreaMarelli\ImetCore\Controllers;

use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \ImetUser as User;


trait DevUsers{

    /**
     * Create DEV users (in dev env)
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create_dev_users(): RedirectResponse
    {
        if(App::environment('imetglobal_dev')){

            // ######  Logout  ######
            Auth::logout();

            DB::beginTransaction();

            // ######  Destroy DEV users if already exists  ######
            User::destroy(99999);
            User::destroy(99998);
            User::destroy(99997);
            User::destroy(99996);

            // ######  Create new DEV users (one for each ROLE type)  ######

            // Administrator
            User::create([
                'id' => 99999,
                'first_name' =>  'TestUser',
                'last_name' => 'Administrator',
                'imet_role' => Role::ROLE_ADMINISTRATOR
            ]);

            // Authority
            $user = User::create([
                'id' => 99998,
                'first_name' =>  'TestUser',
                'last_name' => 'Authority',
                'imet_role' => Role::ROLE_AUTHORITY
            ]);
            $user->imet_roles()->create(['country' => 'CMR']);
            $user->imet_roles()->create(['wdpa' => '61707']);

            // Encoder
            $user = User::create([
                'id' => 99997,
                'first_name' =>  'TestUser',
                'last_name' => 'Encoder',
                'imet_role' => Role::ROLE_ENCODER
            ]);
            $user->imet_roles()->create(['country' => 'BDI']);
            $user->imet_roles()->create(['wdpa' => '20166']);
            $user->imet_roles()->create(['wdpa' => '30674']);
            $user->imet_roles()->create(['wdpa' => '555547988']);

            // Observatory
            $user = User::create([
                'id' => 99996,
                'first_name' =>  'TestUser',
                'last_name' => 'Observatory',
                'imet_role' => Role::ROLE_OBSERVATORY
            ]);
            $user->imet_roles()->create(['country' => 'BDI']);

            DB::commit();

            // ######  Login as Administrator  ######
            Auth::loginUsingId(99999);

            return redirect()->route('dashboard');
        }
        abort(404);
    }

    /**
     * Route to change user (in dev env)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function change_user(Request $request)
    {
        // Create test users
        if(App::environment('imetglobal_dev')){

            $role = $request->input('imet_role');
            Auth::logout();

            if($role == Role::ROLE_ADMINISTRATOR){
                Auth::loginUsingId(99999);
            } else if($role == Role::ROLE_AUTHORITY){
                Auth::loginUsingId(99998);
            } else if($role == Role::ROLE_ENCODER){
                Auth::loginUsingId(99997);
            } else if($role == Role::ROLE_OBSERVATORY){
                Auth::loginUsingId(99996);
            } else {
                abort(505);
            }

            return redirect()->route('dashboard');

        } else {
            abort(404);
        }
    }


}