@push('scripts')
<!--    Scripts solicitudes
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
                temp_solicitude_id: '{{$temporal->id}}',
                item_id: '',
                cantidad: '1',
            },
            detalleEdita: {
                id: '',
                temp_solicitude_id: '{{$temporal->id}}',
                item_id: '',
                cantidad: ''
            },
            detalleVacio: {
                temp_solicitude_id: '{{$temporal->id}}',
                item_id: '',
                cantidad: '1',
            },
            loadingBtnUpdateDet: false,
            loadingBtnAdd: false,
            idEliminando: ''

        },
        methods: {
            nf(cant){
              return numf(cant);
            },
            getDets: function(page) {
                var urlKeeps = '{{route('api.solicitud_detalles.index')}}';
                var params = {
                    params:{
                        'temp_solicitude_id': '{{$temporal->id}}',
                    }
                };

                axios.get(urlKeeps,params).then(response => {
                    this.detalles = response.data.data
                });
            },
            createDet: function() {
                this.loadingBtnAdd= true;
                var url= '{{route("api.solicitud_detalles.store")}}';

                axios.post(url, this.nuevoDetalle ).then(response => {
                    this.getDets();

                    this.nuevoDetalle = this.detalleVacio;

                    iziTs(response.data.message); //mensaje
                    this.loadingBtnAdd= false;

                    slc2item.empty().trigger('change');
                    slc2item.select2('open');
                    $("#div-info-item").html('');

                }).catch(error => {
                    $.each(error.response.data.errors,function (campo,msj) {
                        iziTe(msj);
                    });
                    this.loadingBtnAdd= false;
                });
            },
            editDet: function(det) {

                this.detalleEdita.id= det.id;
                this.detalleEdita.item_id= det.item_id;
                this.detalleEdita.cantidad= det.cantidad;

                $('#modalEditDetalle').modal('show');
            },
            updateDet: function(id) {
                this.loadingBtnUpdateDet= true;
                var url = '{{url('api/solicitud_detalles')}}' + '/' + id;

                axios.put(url, this.detalleEdita).then(response => {
                    this.getDets();
                    $('#modalEditDetalle').modal('hide');
                    iziTs(response.data.message);
                    this.loadingBtnUpdateDet= false;
                }).catch(error => {

                    $.each(error.response.data.errors,function (campo,msj) {
                        iziTe(msj);
                    });

                    this.loadingBtnUpdateDet= false;
                });
            },
            deleteDet: function(det) {
                this.idEliminando = det.id;
                var url = '{{url('api/solicitud_detalles')}}' + '/' + det.id;

                axios.delete(url).then(response => {
                    this.getDets();
                    iziTs(response.data.message);
                    this.idEliminando = '';
                });
            },
            procesar: function () {
                if(this.totalitems>=1){
                    $('#modal-confirma-procesar').modal('show');
                }else {
                    iziTe('No hay ningún artículo en esta solicitud')
                }
            }
        },
        computed: {

            totalitems: function () {
                var t=0;
                $.each(this.detalles,function (i,det) {
                    t+=(det.cantidad*1);
                });

                return t;
            }
        }
    });

    $(function () {
        function formatStateItems (state) {

            var color_stock_less = (state.stock<=0) ? 'color_stock_less' : '';

            var $state = $(
                "@component('components.format_slc2_item')"+
                "@slot('imagen')"+state.img+ "@endslot"+
                "@slot('nombre')"+state.nombre+ "@endslot"+
                "@slot('marca')"+state.nombre_marca+ "@endslot"+
                "@slot('descripcion')"+ state.descripcion+"@endslot"+
                "@slot('precio')"+state.precio_compra+"@endslot"+
                "@slot('ubicacion')"+state.ubicacion+"@endslot"+
                "@slot('stock')"+state.stock_tienda+"@endslot"+
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
                            item[index] = valor===null ? '-' : valor;
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
            templateResult: formatStateItems,
            templateSelection: function(data,contenedor) {

                $("#div-info-item").html(
                    "@component('components.items.show_bar')"+
                    "@slot('imagen')"+data.imagen+ "@endslot"+
                    "@slot('marca')"+ data.nombre_marca+"@endslot"+
                    "@slot('descripcion')"+ data.descripcion+"@endslot"+
                    "@slot('precio')"+data.precio_venta+"@endslot"+
                    "@slot('ubicacion')"+data.ubicacion+"@endslot"+
                    "@slot('stock')"+data.stock_tienda+"@endslot"+
                    "@slot('precio_mayoreo')"+ data.precio_mayoreo+"@endslot"+
                    "@slot('cantidad_mayoreo')"+ data.cantidad_mayoreo+"@endslot"+
                    "@slot('um')"+ data.um+"@endslot"+
                    "@endcomponent"
                );

                vm.nuevoDetalle.item_id = data.id;
                vm.nuevoDetalle.precio = data.precio_compra;

                if(data.stock<=0){
                    $('.select2-result__stock').css('color','#d5404b');
                }

                return data.nombre;
            }
        })
            .on('select2:select',function (e) {
            $('#cant-new-det').focus().select();
        }).on('select2:unselecting',function (e) {
            $("#div-info-item").html('');
        });

        $("#cantidad-new-det").keypress(function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                $("#btn-agregar").focus();
            }
        }).focus(function () {
            $(this).select()
        });

    })
</script>
@endpush
