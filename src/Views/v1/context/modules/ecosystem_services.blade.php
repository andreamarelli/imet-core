<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */


$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))->render();

    // Inject titles
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group0', trans('imet-core::v1_context.EcosystemServices.categories.title1'));
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group3', trans('imet-core::v1_context.EcosystemServices.categories.title2'));
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group6', trans('imet-core::v1_context.EcosystemServices.categories.title3'));

    // Inject average calculation
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group0', 4, 2);
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group1', 4, 2);
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group2', 4, 2);
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group3', 4, 2);
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group4', 4, 2);
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group5', 4, 2);
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group6', 4, 2);
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group7', 4, 2);
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group8', 4, 2);
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group9', 4, 2);


?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            computed: {
                averages(){
                    let _this = this;
                    let averages = [];
                    Object.keys(_this.records).forEach(function(group){
                        averages[group] = _this.calculateAverage('Importance', group);
                    });
                    return averages;
                }
            }

        });
    </script>
@endpush
