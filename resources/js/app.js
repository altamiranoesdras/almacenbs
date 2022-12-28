
require('./bootstrap');

window.Vue = require('vue').default;


require('admin-lte/plugins/jquery-ui/jquery-ui.min');

$.widget.bridge('uibutton', $.ui.button);

require('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js');

require ('admin-lte/plugins/chart.js/Chart.min.js');

require ('admin-lte/plugins/jqvmap/jquery.vmap.min.js');

require ('admin-lte/plugins/jqvmap/maps/jquery.vmap.usa');

require ('admin-lte/plugins/jquery-knob/jquery.knob.min');

require ('admin-lte/plugins/sparklines/sparkline');

require ('admin-lte/plugins/daterangepicker/daterangepicker');

require ('admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min');

// require('admin-lte/plugins/summernote/summernote-bs4.min.js');

require('admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js');

require('admin-lte/dist/js/adminlte.min');


require('datatables.net-bs4');
require('datatables.net-buttons-bs4');
require('datatables.net-responsive-bs4');
require('../../public/vendor/datatables/buttons.server-side');


require('./jquery.bootstrap-duallistbox.js');

window.Cropper  = require('cropperjs/dist/cropper.min');

/**
 * Funciones personalizadas
 */
require('./fn.js');


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

require('bootstrap-toggle/js/bootstrap-toggle.js');


import Multiselect from 'vue-multiselect'

// register globally
Vue.component('multiselect', Multiselect);


import ToggleButton from 'vue-js-toggle-button';
Vue.use(ToggleButton);

window.number_format = require("number_format-php");


import { VTooltip, VPopover, VClosePopover } from 'v-tooltip';

Vue.directive('tooltip', VTooltip);
Vue.directive('close-popover', VClosePopover);
Vue.component('v-popover', VPopover);



function validateNotification() {
    // Let's check if the browser supports notifications
    if (!("Notification" in window)) {
        console.warn("Este navegador no admite notificaciones de escritorio");

        return null;
    }

    // Let's check whether notification permissions have already been granted
    else if (Notification.permission === "granted") {
        // If it's okay let's create a notification
        // notificacionEjemplo();
    }

    // Otherwise, we need to ask the user for permission
    else if (Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {
            // If the user accepts, let's create a notification
            if (permission === "granted") {
                notificacionEjemplo();
            }
        });
    }

    // At last, if the user has denied notifications, and you
    // want to be respectful there is no need to bother them any more.
}

function notificacionEjemplo() {
    new Notification("asi se mostraran las notificaciones!");
}

validateNotification();

window.swal = require('sweetalert2')

$('[data-toggle="tooltip"]').tooltip();


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
