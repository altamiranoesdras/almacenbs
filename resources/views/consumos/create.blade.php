@extends('layouts.app')

@section('titulo_pagina', $consumo->esTemporal() ? 'Nuevo consumo' : 'Editar consumo')

@include('layouts.xtra_condensed_css')
{{--@push('sidebar_class','sidebar-collapse')--}}

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header pb-1 pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">
                        {{ $consumo->esTemporal() ? 'Nuevo consumo' : 'Editar consumo' }}
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

            {!! Form::model($consumo, ['route' => ['consumos.update', $consumo->id], 'method' => 'patch','class' => 'esperar']) !!}
            <div class="row mt-2">

                <!-- Articulos -->
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 ">
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
                                    :consumo="true"
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
                                            v-model="editedItem.cantidad"
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
                                        <td width="75%">Insumo</td>
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
                                        <td class="text-right" v-text="nf(detalle.cantidad)"></td>
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
                                    {{--<small>iniciada: {{fechaHoraLtn($consumo->created_at)}}</small>--}}
                                </strong>
                            </h3>
                            <div class="card-tools pull-right">
                                {{--<button class="btn btn-tool" data-widget="collapse" tabindex="1000"><i class="fa fa-minus"></i></button>--}}
                                {{--<button class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="padding: 0px;">

                            <ul class="list-group">

                                <li class="list-group-item p-2">
                                    <!-- Observaciones Field -->

                                    <div class="form-group col">
                                        {!! Form::label('observaciones', 'Observaciones:') !!}
                                        {!! Form::textarea('observaciones', null, ['class' => 'form-control','rows' => 4]) !!}
                                    </div>
                                </li>


                                <li class="list-group-item pb-0 pl-2 pr-2 ">
                                    <div class="form-group col-sm-12 text-center">



                                        <button type="button" class="btn btn-outline-danger mr-2" data-toggle="modal" data-target="#modalCancelarRequisicion">
                                            <i class="fa fa-ban"></i>
                                            Cancelar
                                        </button>


                                        <button type="submit" class="btn btn-outline-success mr-2" >
                                            <i class="fa fa-save"></i>
                                            Guardar
                                        </button>



                                    </div>
                                </li>

                                @if($consumo->puedeProcesar())
                                    <li class="list-group-item pb-0 pl-2 pr-2 ">
                                        <div class="form-group col-sm-12 text-center">

                                            <button type="button"  class="btn btn-outline-primary" @click="procesar()">
                                                <i class="fa fa-check"></i>
                                                Procesar
                                            </button>

                                        </div>
                                    </li>
                                @endif

                            </ul>

                            <!-- Modal confirm -->
                            <div class="modal fade modal-info" id="modal-confirma-procesar">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Procesar Consumo!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            Seguro que desea continuar?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                            <button type="submit" class="btn btn-primary" name="procesar" value="1" onclick="esperar()">
                                                SI
                                            </button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            <!-- Modal cancel -->
                            <div class="modal fade modal-warning" id="modalCancelarRequisicion">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Cancelar consumo!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            Seguro que desea cancelar la consumo?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                            <a href="{{route('consumos.cancelar',$consumo->id)}}" class="btn btn-danger" onclick="esperar()">
                                                SI
                                            </a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->


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
    <!--    Scripts consumos
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
                    consumo_id : @json($consumo->id),
                },
                defaultItem: {
                    id : 0,
                    consumo_id : @json($consumo->id),
                    item_id: '',
                    cantidad: 0,
                    fecha_vence: '',
                    precio: 0,
                },
                loading: false,

                idEliminando: '',
                maxmimoDetalles : @json(config('consumos.maximo_detalles',20)),


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

                        let params= { params: {consumo_id: @json($consumo->id) } }

                        var res = await axios.get(route('api.consumo_detalles.index'),params);

                        this.detalles  = res.data.data;

                    }catch (e) {
                        notifyErrorApi(e);
                    }

                    this.loading = false;


                },
                async save () {

                    if (this.maxmimoDetalles == this.detalles.length){
                        iziTe("No puede agregar mas detalles, debe agregarlos en otra consumo!")
                        return;
                    }

                    this.loading = true;


                    try {

                        this.editedItem.item_id = this.getId(this.itemSelect);
                        const data = this.editedItem;

                        if(this.editedItem.id === 0){

                            var res = await axios.post(route('api.consumo_detalles.store'),data);

                        }else {

                            var res = await axios.patch(route('api.consumo_detalles.update',this.editedItem.id),data);

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
                        let res = await  axios.delete(route('api.consumo_detalles.destroy',item.id))
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
                        iziTe('No hay ningún artículo en esta consumo')
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
                        t+=(det.cantidad*1);
                    });

                    return t;
                },

            },
            watch:{

                itemSelect (item) {

                    if (item){

                        this.editedItem.precio = item.precio_compra;
                        this.editedItem.item_id = item.id;
                        $(this.$refs.cantidad).focus().select();
                    }else{
                        this.nuevoDetalle = Object.assign({}, this.itemDefault);
                    }
                },
            }

        });
    </script>
@endpush
