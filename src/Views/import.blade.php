@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => !is_imet_environment(), 'links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::form/common.imet_short')
    ]])
@endsection

@if(!is_imet_environment())
    @section('admin_page_title')
        @lang('imet-core::form/common.imet')
    @endsection
@endif

@section('content')
    <div class="module-container" id="import_imet">
        <div class="module-header">
            <div class="module-title">
                @lang('imet-core::form/common.import_imet')
            </div>
        </div>
        <div class="module-body">
            <br/>
            <br/>
            <multiple-files-upload></multiple-files-upload>
        </div>
    </div>
    <script>
        new Vue({
            el: '#import_imet',
        })
    </script>
@endsection
