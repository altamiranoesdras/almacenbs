const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .vue({ version: 2 })
   .sass('resources/sass/app.scss', 'public/css')


    .copy('node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js','public/plugins/datatables/js')
    .copy('node_modules/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js','public/plugins/datatables/js')
    .copy('node_modules/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js','public/plugins/datatables/js')

    .copy('node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css','public/plugins/datatables/css')
    .copy('node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css','public/plugins/datatables/css')
    .copy('node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css','public/plugins/datatables/css')

    .copy('node_modules/bootstrap-fileinput/css/fileinput.min.css','public/plugins/bootstrap-fileinput/css')
    .copy('node_modules/bootstrap-fileinput/img','public/plugins/bootstrap-fileinput/img')
    .copy('node_modules/bootstrap-fileinput/js/locales/es.js','public/plugins/bootstrap-fileinput/js/locales/es.js')
    .copy('node_modules/bootstrap-fileinput/js/fileinput.min.js','public/plugins/bootstrap-fileinput/js/fileinput.min.js')
    .copy('node_modules/bootstrap-fileinput/themes/bs5','public/plugins/bootstrap-fileinput/themes/bs5')
    .copy('node_modules/bootstrap-fileinput/themes/fa6','public/plugins/bootstrap-fileinput/themes/fa')

    .copy('node_modules/jquery-ui/dist/jquery-ui.min.js','public/plugins/jquery-ui')
    .copy('node_modules/jquery-ui/dist/themes/base','public/plugins/jquery-ui/themes/base')

    .version(); // <-- esto crea public/mix-manifest.json
