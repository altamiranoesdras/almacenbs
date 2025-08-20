window._ = require('lodash');



try {

    // window.$ = window.jQuery = require('jquery');

} catch (e) {}


window.axios = require('axios');


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: process.env.MIX_REVERB_APP_KEY,
    cluster: process.env.MIX_REVERB_APP_CLUSTER,
    wsHost: process.env.MIX_REVERB_HOST,
    wsPort: process.env.MIX_REVERB_PORT,
    wssPort: process.env.MIX_REVERB_PORT,
    forceTLS: (process.env.MIX_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
    path: process.env.MIX_REVERB_SERVER_PATH || '/app-reverb',
});

console.log(window.Echo);

// require('webrtc-adapter');
// window.Cookies = require('js-cookie');
//
// import Echo from "laravel-echo"
//
// window.io = require('socket.io-client');
//
// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ':6001'
// });

window.Vue = require('vue').default;


window.Cropper  = require('cropperjs/dist/cropper.min');

window.Swal = require('sweetalert2');


require('bootstrap-toggle/js/bootstrap-toggle.js');
