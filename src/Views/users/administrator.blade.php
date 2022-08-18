<?php
/** @var \AndreaMarelli\ImetCore\Controllers\UsersController $controller */
/** @var string $role */
/** @var \Illuminate\Database\Eloquent\Collection $users_and_roles */

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::common.imet_short')
    ]])
@endsection


@section('content')

    @include('imet-core::users.__menu')

    <div id="users" class="module-container">
        <div class="module-header">
            <div class="module-title col-lg-12">
                {{  ucfirst(trans_choice('imet-core::users.role.'. $role, 2)) }}
            </div>
        </div>

        <div class="module-body">

            <div class="row module-row" v-for="(item, index) in administrators">
                <div class="col-lg-12">
                    <selector-user
                            search-url="{{ route('imet-core::search_users') }}"
                            v-model="administrators[index]"
                            :id="'administrators_'+index"
                            data-class="field-edit"
                    ></selector-user>
                </div>
            </div>

        </div>

    </div>

@endsection



@push('scripts')

    <script>
        new Vue({
            el: '#users',

            data: {
                administrators: @json($users_and_roles)
            },

            mounted: function () {
                this.ensureLastEmpty();
            },

            watch: {
                encoders() {
                    this.ensureLastEmpty();
                }
            },

            methods: {
                ensureLastEmpty() {
                    if (this.administrators[this.administrators.length - 1] !== null) {
                        this.administrators.push(null);
                    }
                }
            }

        });
    </script>



@endpush
