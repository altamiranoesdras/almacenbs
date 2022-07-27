@push('scripts')
<!--    Scripts compras
------------------------------------------------->
<script >
    vm = new Vue({
        el: '#root',
        created: function() {
            this.getDets();
        },
        data: {
            detalles: [],
            nuevoDetalle: {
                temp_compra_id: '{{$temporal->id}}',
                item_id: '',
                cantidad: '1',
                fecha_ven: '',
                precio: '',
            },
            detalleEdita: {
                id: '',
                temp_compra_id: '',
                item_id: '',
                cantidad: '',
                fecha_ven: '',
                precio: '',
            },
            loadingBtnUpdateDet: false,
            loadingBtnAdd: false,
            idEliminando: '',
            tipoComprobante: '2',
            recibido:0,
            picked:'F',
            credito: false,
            ingreso_inmediato: false,
            fecha_ingreso_plan: "{{hoyDb() ?? old('fecha_ingreso_plan')}}",
            abono_ini: null,
            descuento: 0
        },
        methods: {
            fechaFuturo: function(diasFuturo){
                var f = new Date();
                var dias = diasFuturo;
                f.setDate(f.getDate() + dias);
                var fecha = ((f.getDate()) + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
                return fecha;
            },
            numf: function(numero){
                return numf(numero)
            },
            getDets: function(page) {
                var urlKeeps = '{{route('api.compra_detalles.index',$temporal->id)}}';
                axios.get(urlKeeps).then(response => {
                    this.detalles = response.data.data;
                    this.loadingBtnAdd= false;
                    this.idEliminando = '';
                });
            },
            createDet: function() {
                this.loadingBtnAdd= true;
                var url= '{{route("api.compra_detalles.store")}}';

                axios.post(url, this.nuevoDetalle ).then(response => {
                    this.getDets();

                    this.nuevoDetalle.item_id = '';
                    this.nuevoDetalle.cantidad = '1';
                    this.nuevoDetalle.precio = '';

                    iziTs(response.data.message); //mensaje
                    slc2item.empty().trigger('change');
                    slc2item.select2('open');
                    $("#div-info-item").html('');

                }).catch(error => {
                    iziTe(error.response.data.message);
                    this.loadingBtnAdd= false;
                });
            },
            editDet: function(det) {
                this.detalleEdita.id = det.id;
                this.detalleEdita.temp_compra_id = det.temp_compra_id;
                this.detalleEdita.item_id = det.item_id;
                this.detalleEdita.cantidad = det.cantidad;
                this.detalleEdita.precio = det.precio;

                $('#modalEditDetalle').modal('show');
            },
            updateDet: function(id) {
                this.loadingBtnUpdateDet= true;
                var url = '{{url('api/compra_detalles')}}' + '/' + id;

                axios.put(url, this.detalleEdita).then(response => {
                    this.getDets();
                    $('#modalEditDetalle').modal('hide');
                    iziTs(response.data.message);
                    this.loadingBtnUpdateDet= false;
                }).catch(error => {
                    iziTe(error.response.data.message);
                    this.loadingBtnUpdateDet= false;
                });
            },
            deleteDet: function(det) {
                this.idEliminando = det.id;
                var url = '{{url('api/compra_detalles')}}' + '/' + det.id;

                axios.delete(url).then(response => {
                    this.getDets();
                    iziTs(response.data.message);
                });
            },
            procesar: function () {
                if(this.totalitems>=1){
                    $('#modal-confirma-procesar').modal('show');
                }else {
                    iziTe('No hay ningún artículo en este ingreso')
                }
            }
        },
        computed: {
            total: function () {
                var t=0;
                $.each(this.detalles,function (i,det) {
                    t+=(det.cantidad*det.precio);
                });

                if (this.descuento>0){
                    t=t-(t*(this.descuento/100))
                }

                return t;
            },
            totalVenta: function () {
                var t=0;
                $.each(this.detalles,function (i,det) {
                    t+=(det.cantidad*det.item.precio_venta);
                });

                return t;
            },
            ganancia: function(){
               return this.totalVenta - this.total;
            },
            totalitems: function () {
                var t=0;
                $.each(this.detalles,function (i,det) {
                    t+=(det.cantidad*1);
                });

                return t;
            },
            vuelto: function () {
                var t=this.total, r=this.recibido, v=0;

                v=r-t;//Vuelto es igual a recibido menos total

                return v<1 ? 0 : v.toFixed(0);
            },
            cantidadDecimalesPrecio: function () {
                return '{{config('app.cantidad_decimales_precio')}}';
            }
        },
        watch:{
            ingreso_inmediato(val){
                if(val){
                    this.fecha_ingreso_plan = '{{hoyDb()}}'
                }

            }
        }

    });

    $(function () {
        function formatStateItems (state) {

            var imagen= state.thumb;

            var color_stock_less = (state.stock_tienda<=0) ? 'color_stock_less' : '';

            var $state = $(
                "@component('components.format_slc2_item')"+
                "@slot('imagen')"+imagen+ "@endslot"+
                "@slot('nombre')"+state.nombre+ "@endslot"+
                "@slot('marca')"+state.nombre_marca+ "@endslot"+
                "@slot('descripcion')"+ state.descripcion+"@endslot"+
                "@slot('precio')"+numf(state.precio_compra)+"@endslot"+
                "@slot('ubicacion')"+state.ubicacion+"@endslot"+
                "@slot('stock')"+numf(state.stock_tienda)+"@endslot"+
                "@slot('codigo')"+state.codigo+"@endslot"+
                "@slot('color_stock_less')"+color_stock_less+"@endslot"+
                "@endcomponent"
            );

            return $state;
        };

        slc2item=$("#items").select2({
            language : 'es',
            maximumSelectionLength: 1,
            placeholder: "Ingrese código,nombre o descripción para la búsqueda",
            delay: 250,
            ajax: {
                url: "{{ route('api.items.index') }}",
                dataType: 'json',
                data: function (params) {
                    return {
                        search: params.term,
                        tienda: '{{session('tienda')}}'
                    };
                },
                processResults: function (data, params) {
                    //recorre todos los item q
                    var data = $.map(data.data, function (item) {

                        //recorre los atributos del item
                        $.each(item,function (index,valor) {
                            //Si no existe valor se asigan un '-' al attributo
                            item[index] = valor=== null ? '-' : valor;
                        });

                        return item;
                    });

                    return {
                        results: data,
                    };
                },
                cache: true
            },
            minimumInputLength: 1,
            templateResult: formatStateItems
        }).on('select2:select',function (data,e) {

            var item = data.params.data;

            $.each(item,function (index,valor) {
                //Si no existe valor se asigan un '-' al attributo
                item[index] = valor=== null ? '-' : valor;
            });

            $("#div-info-item").html(
                "@component('components.items.show_bar')"+
                "@slot('imagen')"+item.img+ "@endslot"+
                "@slot('marca')"+ item.marca.nombre+"@endslot"+
                "@slot('descripcion')"+ item.descripcion+"@endslot"+
                "@slot('precio')"+numf(item.precio_venta)+"@endslot"+
                "@slot('ubicacion')"+item.ubicacion+"@endslot"+
                "@slot('stock')"+numf(item.stock_tienda)+"@endslot"+
                "@slot('precio_mayoreo')"+ numf(item.precio_mayoreo)+"@endslot"+
                "@slot('cantidad_mayoreo')"+ item.cantidad_mayoreo+"@endslot"+
                "@slot('um')"+ item.um+"@endslot"+
                "@endcomponent"
            );


            if (item.perecedero){
                $('#fv-new-det').prop('readonly',false);
            }else {
                $('#fv-new-det').prop('readonly',true);
                // $('#cant-new-det').focus();
            }

            vm.nuevoDetalle.item_id = item.id;
            vm.nuevoDetalle.precio = item.precio_compra;

            if(item.stock_tienda<=0){
                $('.select2-result__stock').css('color','#d5404b');
            }

            $('#cant-new-det').focus().select();
        }).on('select2:unselecting',function (e) {
            $("#div-info-item").html('');
        });

        $("#fv-new-det,#precio-new-det,#cant-new-det").keypress(function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                $("#btn-agregar").focus();
            }
        }).focus(function () {
            $(this).select()
        });


        $("#fv-new-det").focus(function (e) {
            if($(this).is('[readonly]')){
                $('#cant-new-det').focus().select();
            }
        })



        $("#recibido").keypress(function (e) {
            console.log(e);
            if (e.keyCode == 13) {
                e.preventDefault();
                $("#btn-procesar").focus();
            }
        });

        $("#proveedores").select2({
            language: "es",
            maximumSelectionLength: 1,
            allowClear: true
        });

        $("#btn-confirma-procesar").click(function () {
            $(this).button('loading');
        });

    })
</script>
@endpush
