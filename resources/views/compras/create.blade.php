@extends('layouts.app')

@section('titulo_pagina', 'Ingreso de compra')

@include('layouts.plugins.select2')
@include('layouts.xtra_condensed_css')
@include('layouts.plugins.bootstrap_fileinput')
@push('sidebar_class','sidebar-collapse')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        Ingreso de compra
                    </h2>
                </div>
            </div>
        </div>

        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-primary float-right"
                       href="{{ url()->previous() }}">
                        Regresar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body" id="root">

        <div class="row">
            <div class="col-12">
                @include('layouts.errores')

                {!! Form::model($temporal, ['route' => ['compras.update', $temporal->id], 'method' => 'patch']) !!}
                <div class="row">

                    <!-- Articulos -->
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8">
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
                                    >
                                    </select-items>
                                </div>

                                <div class="row mb-2">

                                    <div class="form-group col-12 col-sm-4 col-md-4 col-lg-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-toggle="tooltip" title="Fecha Vence">
                                                    Fecha Vence
                                                </span>
                                            </div>
                                            <input
                                                v-model="editedItem.fecha_vence"
                                                type="date"
                                                class="form-control"
                                                @keydown.enter.prevent="siguienteCampo('cantidad')"
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group col-12 col-sm-3 col-md-3 col-lg-3">
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
                                                @keydown.enter.prevent="siguienteCampo('precio')"
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group  col-12 col-sm-5 col-md-5 col-lg-5">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-toggle="tooltip" title="Precio compra">{{ dvs() }}</span>
                                            </div>
                                            <input
                                                v-model="editedItem.precio"
                                                type="number"
                                                min="0" step="any"
                                                ref="precio"
                                                class="form-control"
                                                placeholder="Precio compra"
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

                                @include('compras.tabla_det_vue')
                            </div>
                        </div>
                    </div>
                    <!-- /. Articulos -->

                    <!-- Resumen -->
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4">
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
        </div>

    </div>

@endsection


@push('scripts')
    <!--    Scripts compras
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
                    compra_id : @json($temporal->id),
                },
                defaultItem: {
                    id : 0,
                    compra_id : @json($temporal->id),
                    item_id: '',
                    cantidad: 0,
                    fecha_vence: '',
                    precio: 0,
                },
                loading: false,

                idEliminando: '',
                ingreso_inmediato: false,

                fecha_ingreso_plan: "{{hoyDb() ?? old('fecha_ingreso_plan')}}",

                proveedor: @json($compra->proveedor ?? Proveedor::find(old('proveedor_id')) ?? null),
                tipo: @json($compra->tipo ?? CompraTipo::find(old('tipo_id')) ?? CompraTipo::find(CompraTipo::FACTURA)),
                descuento: @json($compra->descuento ?? old('descuento') ?? 0),

            },
            methods: {

                nfp: function(numero){
                    console.log(numero);
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

                        let params= { params: {compra_id: @json($temporal->id) } }

                        var res = await axios.get(route('api.compra_detalles.index'),params);

                        this.detalles  = res.data.data;

                    }catch (e) {
                        notifyErrorApi(e);
                    }

                    this.loading = false;


                },
                async save () {

                    this.loading = true;


                    try {

                        this.editedItem.item_id = this.getId(this.itemSelect);
                        const data = this.editedItem;

                        if(this.editedItem.id === 0){

                            var res = await axios.post(route('api.compra_detalles.store'),data);

                        }else {

                            var res = await axios.patch(route('api.compra_detalles.update',this.editedItem.id),data);

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
                        let res = await  axios.delete(route('api.compra_detalles.destroy',item.id))
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
                        iziTe('No hay ningún artículo en este ingreso')
                    }
                },
                siguienteCampo: function (campo){

                    if (campo=='agregar'){
                        $(this.$refs[campo]).focus().select();
                    }else {

                        $(this.$refs[campo]).focus().select();
                    }
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
                total: function () {
                    var t=0;
                    var descuento = parseFloat(this.descuento || 0);


                    $.each(this.detalles,function (i,det) {
                        t+=det.sub_total;
                    });

                    if (!isNaN(descuento) && descuento > 0 && t>0){
                        t-=descuento;
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

                esFactura(){
                    if (this.tipo){
                        return this.tipo.id= @json(\App\Models\CompraTipo::FACTURA)
                    }

                    return false;
                }
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
