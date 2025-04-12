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

// import Echo from "laravel-echo"
//
// window.Pusher = require('pusher-js');
//
// window.Echo = new Echo({
//     broadcaster:       'pusher',
//     key:               process.env.MIX_PUSHER_APP_KEY,
//     wsHost:            window.location.hostname,
//     wsPort:            6002,
//     wssPort:           6002,
//     disableStats:      false,
//     encrypted:         true,
//     enabledTransports: ['ws', 'wss'],
// });


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
