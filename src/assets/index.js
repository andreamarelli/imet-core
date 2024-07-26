// Import stylesheets
import '@imet-core/index.css';

// Global variables - make them accessible from modules and from blade views
window.Laravel = window.Laravel || {};
window.ImetCore = {};

// ##############################################
// ###########  Helpers & Components  ###########
// ##############################################
window.ImetCore.Helpers = {};
window.ImetCore.Components = {};

// Vue Mixins
// window.ImetCore.Mixins = {
//     status: require('./js/mixins/save_or_reset.mixin'),
//     load_from_previous: require('./js/mixins/load_from_previous.mixin'),
//     key_elements: require('./js/mixins/key_elements.mixin').default
// };

import BiopamaWDPA from './js/helpers/biopamaWDPA.js';
window.ImetCore.Helpers.BiopamaWDPA = BiopamaWDPA;

// ############################################
// ##################  Apps  ##################
// ############################################
window.ImetCore.Apps = {};

import BaseImet from './js/apps/Base.js'; // Extend Base from ModularForms
window.ImetCore.Apps.Base = BaseImet;

import FormListImet from './js/apps/FormList.js';  // Extend FormList from ModularForms
window.ImetCore.Apps.FormList = FormListImet;


// // Templates
// Vue.component('dopa_chart_bar',                 require('./js/templates/dopa/chart_bar.vue').default);
// Vue.component('dopa_indicators_table',          require('./js/templates/dopa/indicators_table.vue').default);
// Vue.component('dopa_radar',                     require('./js/templates/dopa/chart_radar.vue').default);
// window.ImetCore.Dopa = {
//     'chart_bar': require('./js/templates/dopa/chart_bar.vue').default,
//     'chart_doughnut': require('./js/templates/dopa/chart_doughnut.vue').default
// };
// Vue.component('imet_charts',                    require('./js/templates/imet_charts.vue').default);
// Vue.component('imet_encoders_responsibles',     require('./js/templates/imet_encoders_responsibles.vue').default);
// Vue.component('imet_progress_bar',              require('./js/templates/imet_progress_bar.vue').default);
// Vue.component('imet_radar',                     require('./js/templates/imet_radar.vue').default);
// Vue.component('imet_bar_chart',                 require('./js/templates/imet_bar_chart.vue').default);
//
// // Inputs
// Vue.component('multiple-files-upload',          require('./js/inputs/multiple-files-upload.vue').default);
// Vue.component('selector-wdpa',                  require('./js/inputs/selector-wdpa.vue').default);
// Vue.component('selector-wdpa_multiple',         require('./js/inputs/selector-wdpa_multiple.vue').default);
// // Vue.component('selector-user',                  require('./js/inputs/selector-user.vue').default);
//
// // Report
// Vue.component('table_input',                    require('./js/report/table_input.vue').default);
// Vue.component('roadmap',                    require('./js/report/roadmap.vue').default);
// Vue.component('objectives',                    require('./js/report/objectives.vue').default);
//
// // Components for IMET scaling up
// require('./js/scaling_up_analysis/components.js');
