<script>
    window.laravel_websocket_port = parseInt('{{config('app.laravel_websockets_port')}}')


</script>

<script src="{{asset("js/sparkline.js")}}"></script>

<script src="{{asset("js/moment.min.js")}}"></script>

<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script>
    @if(config('app.debug'))
    logW("Modo Debug Activo")
    @else
        logConfig.stopLogging = true;
    @endif


    logI('port ws',window.laravel_websocket_port)
    function mostrarNottifis() {
        notificaciones = this.notifis;


    }
    function addComas(nStr){
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '{{ config('app.separador_decimal') }}' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '{{ config('app.separador_miles') }}' + '$2');
        }
        return x1 + x2;
    }

    /**
     * Formatea los numeros con separador de miles, separador decimales y cantidd de decimales mediante llaves de configuración
     * @param nStr
     * @returns {*}
     */
    function numf(nStr){
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '{{ config('app.separador_decimal') }}' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '{{ config('app.separador_miles') }}' + '$2');
        }
        return x1 + x2;
    }

    {{--$('div.alert').not('.alert-important').delay({{config('app.tiempo_oculta_alerta',3)*1000}}).fadeOut(350);--}}
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();

        {{--// Comprobamos si ya nos habían dado permiso--}}
        {{--if (Notification.permission === "granted") {--}}
            {{--var url = "{{route("api.notificaciones.index")}}";--}}
            {{--var params = {params: {user: '{{Auth::user()->id}}'}};--}}

            {{--axios.get(url, params).then(response => {--}}
                {{--// console.log(response.data.data);--}}
                {{--var notifys = response.data.data;--}}

                {{--$.each(notifys, function (index, notify) {--}}
                    {{--notiFyMe(notify.mensaje, notify.mensaje)--}}
                {{--})--}}
            {{--})--}}
                {{--.catch(error => {--}}
                    {{--// console.log(error.response.data);--}}
                {{--});--}}
        {{--}--}}
        function notiFyMe(titulo, mensaje){
            console.log('notiFyMe', mensaje);
            var opciones = {
                body: mensaje,
                icon: 'https://solucionesaltamirano.com/wp-content/uploads/2018/08/logo-a-no-trans.png',
                lang: 'ES',
            };
            var noti = new Notification(titulo, opciones);

            setTimeout(noti.close.bind(noti), 8000);

            noti.onclick = function(event) {
                event.preventDefault(); // prevent the browser from focusing the Notification's tab
                window.open('http://www.solucionesaltamirano.com', '_blank');
            }
        };
    })

    function erroresToList(errors) {

        var res ="<ul style='list-style-type: none; padding:0px;'>";

        $.each(errors,function (field,fieldErrors) {

            $.each(fieldErrors,function (index,error) {
                res = res+'<li>'+error+'</li>';
            })
        })

        return res;
    }

    $.fn.serializeObject = function()
    {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    /**
     * Formatea los datos de los inputs de un formulario
     * solo se utiliza en archivos de servicio DataTable ej: VentaDataTable.php
     * en el método html
     * ->ajax([
     *      'data' => "function(data) { formatDataDatatables($('#form-filter-ventas').serializeArray(), data);   }"
     *  ])
     * @param source
     * @param target
     */
    function formatDataDataTables(source, target) {
        $(source).each(function (i, v) {

            // consola(i, v);
            target[v['name']] = v['value'];
        })

    }
    function cantidad_decimales_precio(){
        return  "{{config('app.cantidad_decimales_precio')}}";
    }


    function cantidad_decimales(){
        return  "{{config('app.cantidad_decimales')}}";
    }

    function dvs() {
        return "{{dvs()}}";
    }

    $(function () {

        $(".form-loading-on-submit,.esperar").submit(function( event ) {

            Swal.fire({
                title: 'Espera por favor...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                timerProgressBar: true,
            });

            Swal.showLoading();
        });
    })

</script>


<!-- Scripts inyectados-->
@stack('scripts')
@yield('scripts')
