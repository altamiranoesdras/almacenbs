@extends('layouts.app')

@section('titulo_pagina', $solicitud->esTemporal() ? 'Nueva requisición' : 'Editar requisición')

@include('layouts.xtra_condensed_css')
{{--@push('sidebar_class','sidebar-collapse')--}}

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header pb-1 pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">
                        {{ $solicitud->esTemporal() ? 'Nueva requisición' : 'Editar requisición' }}
                        @if($solicitud->motivo_retorna)
                            <small class="text-warning">
                                Retornada por {{$solicitud->motivo_retorna}}
                            </small>
                        @endif

                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" >
        <div class="container-fluid">


            @include('layouts.errores')

            {!! Form::model($solicitud, ['route' => ['solicitudes.update', $solicitud->id], 'method' => 'patch','class' => 'esperar']) !!}
                <div class="row mt-2" id="root">

                    <!-- Articulos -->
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <div class="card card-info card-outline">
                            <div class="card-header with-border py-2">
                                <h3 class="card-title">
                                    <strong>Artículos</strong>
                                    <small class="text-muted text-md">
                                        (<i class="fas fa-cubes"></i>Stock)
                                    </small>
                                </h3>
                                <div class="card-tools pull-right">
                                    {{--<button class="btn btn-tool" data-widget="collapse" tabindex="1000"><i class="fa fa-minus"></i></button>--}}
                                    {{--<button class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group mb-4">
                                    <select-items
                                        api="{{route('api.items.index')}}"
                                        tienda="1"
                                        v-model="itemSelect"
                                        ref="multiselect"
                                        :solicitud="true"
                                    >
                                    </select-items>
                                </div>

                                <div class="row pt-3">

                                    <div class="form-group  col-xs-12 col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-toggle="tooltip" title="Cantidad">Cant</span>
                                            </div>
                                            <input
                                                v-model="editedItem.cantidad_solicitada"
                                                type="number"
                                                min="0" step="any"
                                                class="form-control"
                                                ref="cantidad"
                                                @keydown.enter.prevent="siguienteCampo('agregar')"
                                            >
                                            <span class="input-group-append">
                                                    <button type="button" ref="agregar" class="btn btn-success" @click.prevent="save" :disabled="loading" >
                                                        <span v-show="loading" >
                                                            <i class="fa fa-spinner fa-spin"></i>
                                                        </span>
                                                        <span v-show="!loading" class="glyphicon glyphicon-plus"></span>
                                                        Agregar
                                                    </button>
                                                </span>
                                        </div><!-- /input-group -->

                                    </div>
                                </div>

                                <div id="div-info-item"></div>

                                <div class="table-responsive">
                                    <table width="100%"  class="table table-bordered table-xtra-condensed" id="tablaDetalle" style="margin-bottom: 2px">
                                        <thead>
                                        <tr class="bg-primary text-sm" align="center" style="font-weight: bold">
                                            <td width="5%">No.</td>
                                            <td width="75%">Producto</td>
                                            <td width="10%">Cantidad</td>
                                            <td width="10%">-</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-if="detalles.length==0">
                                            <td colspan="6"><span class="help-block text-center">No se ha agregado ningún artículo</span></td>
                                        </tr>
                                        <tr v-for="(detalle,index) in detalles" class="text-sm">
                                            <td v-text="index+1"></td>
                                            <td v-text="detalle.item.text"></td>
                                            <td class="text-right" v-text="nf(detalle.cantidad_solicitada)"></td>
                                            <td class="text-center">
                                                <button type="button" class='btn btn-icon btn-flat-danger rounded-circle'
                                                        @click="deleteItem(detalle)"
                                                        :disabled="(idEliminando===detalle.id)">
                                                    <i  v-show="(idEliminando===detalle.id)" class="fa fa-spinner fa-spin"></i>
                                                    <i v-show="!(idEliminando===detalle.id)" class="fa fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="6" >
                                                <b>Total</b>
                                                <b class="pull-right" v-text="nf(totalitems)"></b>
                                            </td>
                                        </tr>
                                        </tfoot>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /. Articulos -->

                    <!-- Resumen -->
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="card card-info card-outline">
                            <div class="card-header py-2">
                                <h3 class="card-title">
                                    <strong>
                                        Resumen
                                        {{--<small>iniciada: {{fechaHoraLtn($solicitud->created_at)}}</small>--}}
                                    </strong>
                                </h3>
                                <div class="card-tools pull-right">
                                    {{--<button class="btn btn-tool" data-widget="collapse" tabindex="1000"><i class="fa fa-minus"></i></button>--}}
                                    {{--<button class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="padding: 0px;">

                                @include('solicitudes.fields')

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


@endsection

@push('scripts')
    <!--    Scripts solicituds
------------------------------------------------->
    <script >
        vm = new Vue({
            el: '#root',
            mounted() {
                this.abreSelectorItems();
            },
            created: function() {
                this.getItems();
            },
            data: {
                itemSelect: null,

                detalles: [],

                editedItem: {
                    id : 0,
                    solicitud_id : @json($solicitud->id),
                },
                defaultItem: {
                    id : 0,
                    solicitud_id : @json($solicitud->id),
                    item_id: '',
                    cantidad_solicitada: 0,
                    fecha_vence: '',
                    precio: 0,
                },
                loading: false,

                idEliminando: '',
                maxmimoDetalles : @json(config('solicitudes.maximo_detalles',13)),


            },
            methods: {

                nfp: function(numero){
                    let decimales = parseInt(@json(config('app.cantidad_decimales_precio')));
                    return number_format(numero,decimales)
                },
                nf: function(numero){
                    let decimales = parseInt(@json(config('app.cantidad_decimales')));
                    return number_format(numero,decimales)
                },
                getId(item){
                    if(item)
                        return item.id;

                    return null
                },
                editItem (item) {
                    $("#"+this.id).modal('show');
                    this.editedItem = Object.assign({}, item);

                },
                close () {
                    $("#"+this.id).modal('hide');
                    this.loading = false;
                    setTimeout(() => {
                        this.editedItem = Object.assign({}, this.defaultItem);
                    }, 300)
                },

                async getItems () {

                    try {

                        let params= { params: {solicitud_id: @json($solicitud->id) } }

                        var res = await axios.get(route('api.solicitud_detalles.index'),params);

                        this.detalles  = res.data.data;

                    }catch (e) {
                        notifyErrorApi(e);
                    }

                    this.loading = false;


                },
                async save () {

                    if (this.maxmimoDetalles == this.detalles.length){
                        iziTe("No puede agregar mas detalles, debe agregarlos en otra requisición!")
                        return;
                    }

                    this.loading = true;


                    try {

                        this.editedItem.item_id = this.getId(this.itemSelect);
                        const data = this.editedItem;

                        if(this.editedItem.id === 0){

                            var res = await axios.post(route('api.solicitud_detalles.store'),data);

                        }else {

                            var res = await axios.patch(route('api.solicitud_detalles.update',this.editedItem.id),data);

                        }


                        iziTs(res.data.message);
                        this.editedItem = Object.assign({}, this.defaultItem);
                        this.abreSelectorItems();
                        this.getItems();

                    }catch (e) {
                        notifyErrorApi(e);
                        this.loading = false;
                    }

                },
                async deleteItem(item) {

                    this.idEliminando = item.id;
                    try{
                        let res = await  axios.delete(route('api.solicitud_detalles.destroy',item.id))
                        logI(res.data);

                        iziTs(res.data.message);
                        this.getItems();


                    }catch (e){
                        notifyErrorApi(e);
                        this.idEliminando = '';
                    }


                },

                procesar: function () {
                    if(this.totalitems>=1){
                        $('#modal-confirma-procesar').modal('show');
                    }else {
                        iziTe('No hay ningún artículo en esta requisición')
                    }
                },
                siguienteCampo: function (campo){

                    $(this.$refs[campo]).focus().select();
                },
                abreSelectorItems () {
                    this.itemSelect = null;
                    this.$refs.multiselect.$refs.multiselect.$el.focus();

                }
            },
            computed: {

                dvs: function(){
                    return @json(dvs())
                },


                totalitems: function () {
                    var t=0;
                    $.each(this.detalles,function (i,det) {
                        t+=(det.cantidad_solicitada*1);
                    });

                    return t;
                },

            },
            watch:{

                itemSelect (item) {

                    if (item){

                        this.editedItem.precio = item.precio_compra;
                        this.editedItem.item_id = item.id;
                        $(this.$refs.cantidad_solicitada).focus().select();
                    }else{
                        this.nuevoDetalle = Object.assign({}, this.itemDefault);
                    }
                },
            }

        });
    </script>
@endpush
