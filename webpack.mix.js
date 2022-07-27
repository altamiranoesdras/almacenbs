const mix = require('laravel-mix');

require('dotenv').config();

mix.js('resources/js/app.js', 'public/js')
    .vue({ version: 2 })
   .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/admin-lte/dist/img','public/dist/img')
    .copy('node_modules/admin-lte/plugins/sparklines/sparkline.js','public/js')
    .copy('node_modules/admin-lte/plugins/moment/moment.min.js','public/js')
    // .copy('node_modules/admin-lte/dist/js/pages/dashboard.js','public/js')
    .copy('node_modules/admin-lte/dist/js/demo.js','public/js')

    .copy('node_modules/admin-lte/plugins/fullcalendar/main.min.css','public/plugins/fullcalendar')

    .copy('node_modules/admin-lte/plugins/fullcalendar/main.min.js','public/plugins/fullcalendar')


    .copy('node_modules/bootstrap-fileinput','public/plugins/bootstrap-fileinput')
    .copy('node_modules/select2','public/plugins/select2')


    .copy('node_modules/gijgo/js/gijgo.min.js','public/js')
    .copy('node_modules/gijgo/js/messages/messages.es-es.min.js','public/js')
    .copy('node_modules/gijgo/css/gijgo.min.css','public/css')
    .copy('node_modules/gijgo/fonts','public/fonts')

    // .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css');
