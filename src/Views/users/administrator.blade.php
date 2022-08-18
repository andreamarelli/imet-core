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

            <form method="post" action="{{ route('imet-core::users_update') }}">
                @method('PATCH')
                @csrf
                <div class="row module-row" v-for="(item, index) in records">
                    <div class="col-lg-12">

                        <!-- user selector -->
                        <selector-user
                                search-url="{{ route('imet-core::search_users') }}"
                                v-model="records[index]"
                                :id="'records_'+index"
                                data-class="field-edit"
                        ></selector-user>

                    </div>
                </div>
            </form>
        </div>

        {{-- save action bars --}}
        @include('modular-forms::module.save_bar')

    </div>

@endsection



@push('scripts')

    <script>
        new Vue({
            el: '#users',

            mixins: [
                window.mixins['status']
            ],

            data: {
                records: @json($users_and_roles)
            },

            created: function () {
                this.ensureLastEmpty();
            },

            watch: {

                records:{
                    handler: function () {
                        this.ensureLastEmpty();
                    },
                    deep: true
                }

            },

            methods: {
                ensureLastEmpty() {
                    if (this.records[this.records.length - 1] !== null) {
                        this.records.push(null);
                    }
                },

                saveData(){

                    let form = this.$el.querySelector('form');
                    let url = form.getAttribute('action');
                    let method = form.getAttribute('method');
                    let form_data = new FormData(form);
                    form_data.append('records', JSON.stringify(this.records));

                    fetch(url, {
                        method: method,
                        body: form_data
                    })
                        .then(function(response) {
                            return response.json();
                        }).then(function(data) {
                        console.log(data);
                    }).catch(function() {
                        console.log("Error");
                    });
                },

            }

        });
    </script>



@endpush
