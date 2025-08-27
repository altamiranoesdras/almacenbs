<!DOCTYPE html>

@php
    if(!session('mode-layout')){
        $mode_layout = App\Models\UserConfiguration::where('user_id', auth()->user()->id)->where('key', 'app.mode-layout')->get()->first()->value ?? 'light-layout';
        session(['mode-layout' => $mode_layout]);
    }else{
        $mode_layout = session('mode-layout');
    }

@endphp

<html class="loading {{ $mode_layout }}" lang="es" data-layout="{{ $mode_layout }}" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield("titulo_pagina") - {{config('app.name')}} </title>
    <meta name="description" content="{{config('app.meta_descripcion')}}">
    <meta name="keywords" content="{{config('app.meta_keywords')}}">
    <meta name="author" content="Soluciones Altamirano">

    <link rel="apple-touch-icon" href="{{getIcono('180x180')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{getIcono('32x32')}}">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">


    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    @stack('estilos_dt')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- END: Custom CSS-->

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" type="text/css" />

    @stack('estilos')

    <style>
        /* El contenedor elegido (scrollBody o padre de la tabla) será relativo */
        .dt-overlay-container {
            position: relative !important;
        }

        /* Capa que SOLO cubre el área de la tabla */
        .dt-processing-on-table {
            position: absolute;
            inset: 0;
            z-index: 9999;
            display: none;
            pointer-events: none;            /* no bloquea escribir/clicks */
        }

        /* Fondo opacado SOLO sobre la tabla */
        .dt-processing-on-table::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(2px);
        }

        /* Toast centrado */
        .dt-processing-on-table .box {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            color: #1f1f1f;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,.18), 0 2px 8px rgba(0,0,0,.12);
            border: 1px solid rgba(0,0,0,.06);
        }

        .dt-processing-on-table .spinner-border {
            width: 1.35rem;
            height: 1.35rem;
        }




    </style>


</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    @include('layouts.partials.navbar')
    @include('layouts.partials.sidebar')


    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

                @yield('content')

        </div>
    </div>
    <!-- END: Content-->


    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('layouts.partials.footer')


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->



    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

    @include('layouts.partials.flash_alert')
    @routes




    <script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>



    @stack('scripts')


    <script>
        $(function () {
            var dt      = window.LaravelDataTables["dataTableBuilder"];
            var $table  = $('#dataTableBuilder'); // usa el id real de tu tabla

            function ensureOverlay() {
                var $wrapper = $(dt.table().container());
                if (!$wrapper.find('.dt-processing-custom').length) {
                    $wrapper.css('position', 'relative'); // refuerzo
                    $wrapper.append(
                        '<div class="dt-processing-custom">'+
                        '<div class="box">'+
                        '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>'+
                        'Procesando...'+
                        '</div>'+
                        '</div>'
                    );
                }
                return $wrapper.find('.dt-processing-custom');
            }

            // Insertar overlay una vez cuando DataTables termine de inicializar
            $table.one('init.dt', function(){ ensureOverlay(); });

            // Mostrar overlay antes de cada request
            $table.on('preXhr.dt', function () {
                ensureOverlay().show();
            });

            // Mostrar overlay al dibujar (redibujar) la tabla
            $table.on('draw.dt', function () {
                ensureOverlay().show();
            });

            // Ocultar al recibir datos, al dibujar, o ante error
            $table.on('xhr.dt draw.dt error.dt', function () {
                ensureOverlay().hide();
            });
        });

    </script>

</body>
</html>
