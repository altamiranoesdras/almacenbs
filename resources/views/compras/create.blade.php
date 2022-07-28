@extends('layouts.app')

@section('htmlheader_title','Compra o Ingreso')


@include('layouts.plugins.select2')
@include('layouts.xtra_condensed_css')
@include('layouts.plugins.bootstrap_fileinput')
@push('sidebar_class','sidebar-collapse')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header pb-1 pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">
                        Nueva Compra o Ingreso
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" id="root">
        <div class="container-fluid">


            @include('layouts.errores')

            {!! Form::model($temporal, ['route' => ['compras.update', $temporal->id], 'method' => 'patch']) !!}
            <div class="row mt-2">

                    <!-- Articulos -->
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <div class="card card-warning card-outline">
                            <div class="card-header with-border py-2">
                                <h3 class="card-title">
                                    <strong>Artículos</strong>
                                    <small class="text-muted text-md">
                                        (<i class="fas fa-cubes"></i>Stock)
                                        (<i class="fas fa-archive"></i>Ubicacion)
                                    </small>
                                </h3>
                                <div class="card-tools pull-right">
                                    {{--<button class="btn btn-tool" data-widget="collapse" tabindex="1000"><i class="fa fa-minus"></i></button>--}}
                                    {{--<button class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <select-items
                                        api="{{route('api.items.index')}}"
                                        tienda="1"
                                        v-model="itemSelect"
                                        ref="multiselect"
                                    >
                                    </select-items>
                                </div>

                                <div class="row pt-3">
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-toggle="tooltip" title="Fecha Vence">FV</span>
                                            </div>
                                            <input v-model="nuevoDetalle.fecha_ven" id="fv-new-det" type="date" name="fecha_ven"  class="form-control"  data-toggle="tooltip" title="Doble Enter para agregar">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-toggle="tooltip" title="Cantidad">Cant</span>
                                            </div>
                                            <input v-model="nuevoDetalle.cantidad" type="number" min="0" step="1" name="cantidad" id="cant-new-det"  class="form-control"  value="1" data-toggle="tooltip" title="Doble Enter para agregar">
                                        </div>
                                    </div>
                                    <div class="form-group  col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-toggle="tooltip" title="Precio compra">{{ dvs() }}</span>
                                            </div>
                                            <input v-model="nuevoDetalle.precio" type="number" min="0" step="1" id="precio-new-det" class="form-control" placeholder="Precio compra" data-toggle="tooltip" title="Doble Enter para agregar">
                                            <span class="input-group-append">
                                                    <button type="button" id="btn-agregar" class="btn btn-success" v-on:click.prevent="createDet" :disabled="loadingBtnAdd" >
                                                        <span v-show="loadingBtnAdd" >
                                                            <i class="fa fa-sync-alt fa-spin"></i>
                                                        </span>
                                                        <span v-show="!loadingBtnAdd" class="glyphicon glyphicon-plus"></span>
                                                        Agregar
                                                    </button>
                                                </span>
                                        </div><!-- /input-group -->

                                    </div>
                                </div>

                                <div id="div-info-item"></div>

                                @include('compras.tabla_det_vue')
                            </div>
                        </div>
                    </div>
                    <!-- /. Articulos -->

                    <!-- Resumen -->
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="card card-warning card-outline">
                            <div class="card-header py-2">
                                <h3 class="card-title">
                                    <strong>
                                        Resumen
                                        {{--<small>iniciada: {{fechaHoraLtn($temporal->created_at)}}</small>--}}
                                    </strong>
                                </h3>
                                <div class="card-tools pull-right">
                                    {{--<button class="btn btn-tool" data-widget="collapse" tabindex="1000"><i class="fa fa-minus"></i></button>--}}
                                    {{--<button class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="padding: 0px;">

                                @include('compras.fields')

                            </div>
                        </div><!-- /.row -->
                    </div>
                    <!-- /. Resumen -->


{{--                @include('ventas.edit_modal_detalle')--}}
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    @include('compras.modal_provs')
    @include('items.modal_form_create')

@endsection

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
                    compra_id: '{{$temporal->id}}',
                    item_id: '',
                    cantidad: '1',
                    fecha_ven: '',
                    precio: '',
                },
                detalleEdita: {
                    id: '',
                    compra_id: '',
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
                descuento: 0,
                proveedor: null,
                tipo: null,
            },
            methods: {

                numf: function(numero){
                    return number_format(numero)
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

                totalitems: function () {
                    var t=0;
                    $.each(this.detalles,function (i,det) {
                        t+=(det.cantidad*1);
                    });

                    return t;
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
    </script>
@endpush
