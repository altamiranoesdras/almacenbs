/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


import Multiselect from 'vue-multiselect'
import ToggleButton from 'vue-js-toggle-button';
import DualListBoxRoles from "./components/DualListBoxRoles";
import DualListBoxPermisos from "./components/DualListBoxPermisos";
import {VClosePopover, VPopover, VTooltip} from 'v-tooltip';
import SelectItems from "./components/SelectItems";
import SelectProveedor from "./components/SelectProveedor";
import SelectCompraTipo from "./components/SelectCompraTipo";
import SelectMarca from "./components/SelectMarca";
import SelectRenglon from "./components/SelectRenglon";
import SelectUnimed from "./components/SelectUnimed";
import SelectItemTipo from "./components/SelectItemTipo";
import SelectUnidad from "./components/SelectUnidad";
import SelectPuesto from "./components/SelectPuesto";
import SelectActivo from "./components/SelectActivo";
import SelectColaborador from "./components/SelectColaborador";
import SelectActivoSolicitudTipo from "./components/SelectActivoSolicitudTipo";
import SelectBodegas from "./components/SelectBodegas";
import SelectItemPresentacion from "./components/SelectItemPresentacion";
import SelectItemModelo from "./components/SelectItemModelo";
import DualListBoxCompraRequisicionEstados from "./components/DualListBoxCompraRequisicionEstados";
import RedProduccion from "./components/red_produccion_resultados/RedProduccion.vue";
import EstructuraPresupuestaria from "./components/estructura_presupuestaria_programas/EstructuraPresupuestaria.vue";

//Pruebas
import Pruebas from "./components/Pruebas.vue";

// Traducción global para vue-multiselect (Vue 2)
const MultiselectEs = {
    extends: Multiselect,
    props: {
        // Textos de accesibilidad y placeholders
        selectLabel:   { type: String, default: 'Presiona Enter para seleccionar' },
        selectedLabel: { type: String, default: 'Seleccionado' },
        deselectLabel: { type: String, default: 'Presiona Enter para quitar' },
        placeholder:   { type: String, default: 'Selecciona una opción' },

        // Mensajes de lista vacía / sin resultados
        // En vue-multiselect v2 suelen ser 'noOptions' y 'noResult'
        noOptions:     { type: String, default: 'No hay opciones disponibles' },
        noResult:      { type: String, default: 'No se encontraron resultados' },

        // Texto cuando hay muchos seleccionados (ej. “y 3 más”)
        limitText: {
            type: Function,
            default: (count) => `y ${count} más`
        }
    }
}

// Registrar el wrapper como el componente global por defecto
Vue.component('multiselect', MultiselectEs)


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

Vue.component('dual-listbox-roles',DualListBoxRoles)

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


Vue.directive('tooltip', VTooltip);
Vue.directive('close-popover', VClosePopover);
Vue.component('v-popover', VPopover);


Vue.component('select-items', SelectItems);

Vue.component('select-proveedor', SelectProveedor);

Vue.component('select-compra-tipo',SelectCompraTipo)

Vue.component('select-marca',SelectMarca)

Vue.component('select-renglon',SelectRenglon)

Vue.component('select-unimed',SelectUnimed)

Vue.component('select-item-tipo',SelectItemTipo);

Vue.component('select-unidad',SelectUnidad)

Vue.component('select-puesto',SelectPuesto)

Vue.component('select-activo',SelectActivo)

Vue.component('select-colaborador',SelectColaborador)

Vue.component('select-activo-solicitud-tipo',SelectActivoSolicitudTipo)

Vue.component('select-bodega',SelectBodegas)

Vue.component('select-item-presentacion',SelectItemPresentacion)

Vue.component('select-item-modelo',SelectItemModelo);

Vue.component('dual-listbox-compra-requisicion-estados',DualListBoxCompraRequisicionEstados);

Vue.component('red-produccion',RedProduccion);

Vue.component('estructura-presupuestaria',EstructuraPresupuestaria);

//Pruebas
Vue.component('pruebas',Pruebas);



