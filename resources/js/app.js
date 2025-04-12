/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');




import Multiselect from 'vue-multiselect'

// register globally
Vue.component('multiselect', Multiselect);


import ToggleButton from 'vue-js-toggle-button';
Vue.use(ToggleButton);

window.number_format = require("number_format-php");


// import { VTooltip, VPopover, VClosePopover } from 'v-tooltip';

// Vue.directive('tooltip', VTooltip);
// Vue.directive('close-popover', VClosePopover);
// Vue.component('v-popover', VPopover);


/**
 * Funciones personalizadas
 */
require('./fn.js');

import DualListBoxRoles from "./components/DualListBoxRoles";
Vue.component('dual-listbox-roles',DualListBoxRoles)

import DualListBoxPermisos from "./components/DualListBoxPermisos";
Vue.component('dual-listbox-permisos',DualListBoxPermisos)


var { log, logI, logD, logW, logE, logConfig } = require("./override-console-log");

window.log = log;
window.logI = logI;
window.logD = logD;
window.logW = logW;
window.logE = logE;
window.logConfig = logConfig;

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);


window.number_format = require("number_format-php");


import { VTooltip, VPopover, VClosePopover } from 'v-tooltip';

Vue.directive('tooltip', VTooltip);
Vue.directive('close-popover', VClosePopover);
Vue.component('v-popover', VPopover);



import SelectItems from "./components/SelectItems";
Vue.component('select-items', SelectItems);

import SelectProveedor from "./components/SelectProveedor";
Vue.component('select-proveedor', SelectProveedor);

import SelectCompraTipo from "./components/SelectCompraTipo";
Vue.component('select-compra-tipo',SelectCompraTipo)

import SelectMarca from "./components/SelectMarca";
Vue.component('select-marca',SelectMarca)

import SelectRenglon from "./components/SelectRenglon";
Vue.component('select-renglon',SelectRenglon)

import SelectUnimed from "./components/SelectUnimed";
Vue.component('select-unimed',SelectUnimed)

import SelectItemTipo from "./components/SelectItemTipo";
Vue.component('select-item-tipo',SelectItemTipo);

import SelectUnidad from "./components/SelectUnidad";
Vue.component('select-unidad',SelectUnidad)

import SelectPuesto from "./components/SelectPuesto";
Vue.component('select-puesto',SelectPuesto)

import SelectActivo from "./components/SelectActivo";
Vue.component('select-activo',SelectActivo)

import SelectColaborador from "./components/SelectColaborador";
Vue.component('select-colaborador',SelectColaborador)

import SelectActivoSolicitudTipo from "./components/SelectActivoSolicitudTipo";
Vue.component('select-activo-solicitud-tipo',SelectActivoSolicitudTipo)

import SelectBodegas from "./components/SelectBodegas";
Vue.component('select-bodega',SelectBodegas)

import SelectItemPresentacion from "./components/SelectItemPresentacion";
Vue.component('select-item-presentacion',SelectItemPresentacion)

import SelectItemModelo from "./components/SelectItemModelo";
Vue.component('select-item-modelo',SelectItemModelo);
