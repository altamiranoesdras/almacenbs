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


