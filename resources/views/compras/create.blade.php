@extends('layouts.app')

@section('titulo_pagina', 'Nuevo Ingreso de almacén')

@include('layouts.plugins.select2')
@include('layouts.xtra_condensed_css')
@include('layouts.plugins.bootstrap_fileinput')
@push('sidebar_class','sidebar-collapse menu-collapsed')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        Nuevo Ingreso de almacén
                    </h2>
                </div>
            </div>
        </div>

        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-primary float-right"
                       href="{{ url()->previous() }}">
                        <i class="fa fa-arrow-left"></i>
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
                    <div class="col-12 ">
                        <div class="card card-warning card-outline">
                            <div class="card-header with-border py-2">
                                <h3 class="card-title">
                                    <strong>Insumos / Detalles</strong>
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
                                                    <span v-show="!loading" class="glyphicon"></span>
                                                    <i class="fa fa-plus"></i>
                                                    Agregar
                                                </button>
                                            </span>
                                        </div><!-- /input-group -->
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table  class="table table-bordered table-sm table-striped" id="tablaDetalle" style="margin-bottom: 2px">
                                        <thead>
                                        <tr class="text-sm">
                                            <td width="50%">Producto</td>
                                            <td width="10%">Precio</td>
                                            <td width="10%">Cantidad</td>
                                            <td width="10%">Fecha V.</td>
                                            <td width="10%">Subtotal</td>
                                            <td width="10%">Unidad Solicitante</td>
                                            <td width="10%">-</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-if="detalle_editable.length==0">
                                            <td colspan="7"><span class="help-block text-center">No se ha agregado ningún artículo</span></td>
                                        </tr>
                                        <tr v-for="detalle in detalle_editable" class="text-sm">
                                            <td v-text="detalle.item.text"></td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm" step="any" v-model="detalle.precio">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm" step="any" v-model="detalle.cantidad">
                                            </td>
                                            <td >
                                                <input type="date" class="form-control form-control-sm" v-model="detalle.fecha_vence">
                                            </td>
                                            <td v-text="dvs + nfp(detalle.sub_total)"></td>
                                            <td v-text="detalle.unidad_solicitante.codigo"></td>
                                            <td width="10px">
                                                {{--<button type="button" class="btn btn-icon btn-flat-info rounded-circle" @click="editDet(detalle)">--}}
                                                {{--<i class="fa fa-edit"></i>--}}
                                                {{--</button>--}}
                                                <button type="button" class='btn btn-icon btn-flat-danger rounded-circle' @click="deleteItem(detalle)" :disabled="(idEliminando===detalle.id)">
                                                    <span v-show="(idEliminando===detalle.id)" >
                                                        <i  class="fa fa-sync-alt fa-spin"></i>
                                                    </span>
                                                                                    <span v-show="!(idEliminando===detalle.id)" >
                                                        <i class="fa fa-trash-alt"></i>
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td >
                                                <b>Descuento (Q)</b>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>

                                                <input type="number" class="form-control" step="any" v-model="descuento" name="descuento" >
                                            <td></td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <td >
                                                <b>Total</b>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <b class="pull-right" v-text="dvs + nfp(total)"></b>
                                            <td></td>
                                            <td></td>

                                        </tr>
                                        </tfoot>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /. Articulos -->

                    <!-- Resumen -->
                    <div class="col-12 ">
                        <div class="card card-warning card-outline">
                            <div class="card-header py-2">
                                <h3 class="card-title">
                                    <strong>
                                        Resumen
                                    </strong>
                                </h3>
                                <div class="card-tools pull-right">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="padding: 0px;">

                                <ul class="list-group">
                                    <li class="list-group-item pb-0 pl-2 pr-2">
                                        <div class="col-sm-12 mb-1">
                                            <label for="unidad_solicita_id" class="sr-only">Unidad Solicitante</label>
                                            <input type="text" class="form-control" placeholder="Unidad Solicitante" value="{{ auth()->user()->unidad->nombre }} - {{ auth()->user()->unidad->codigo }}" readonly>
                                            <input type="hidden" name="unidad_solicita_id" value="{{ auth()->user()->unidad->id }}">
                                        </div>
                                    </li>

                                    <li class="list-group-item pb-0 pl-2 pr-2">
                                        <div class="col-sm-12 mb-1">
                                            <select-proveedor v-model="proveedor" label="Proveedor"></select-proveedor>
                                        </div>
                                    </li>


                                    {{--    <!--            Total--}}
                                    {{--    ------------------------------------------------------------------------>--}}
                                    {{--    <li class="list-group-item pt-1 pb-1 text-bold ">--}}
                                    {{--        <div class="row">--}}
                                    {{--            <div class="col-sm-12 text-lg">--}}
                                    {{--                Total--}}
                                    {{--                <span class="float-right" >--}}
                                    {{--                    {{dvs()}} <span v-text="nfp(total)"></span>--}}
                                    {{--                </span>--}}
                                    {{--            </div>--}}
                                    {{--        </div>--}}

                                    {{--    </li>--}}


                                    {{--    <!--            Numero productos--}}
                                    {{--    ------------------------------------------------------------------------>--}}
                                    {{--    <li class="list-group-item pt-1 pb-1 text-bold text-md">--}}
                                    {{--        Cant. Productos:--}}
                                    {{--        <span class="float-right" v-text="totalitems"></span>--}}
                                    {{--    </li>--}}


                                    <li class="list-group-item pb-0 pl-2 pr-2">
                                        <div class="col-sm-12 mb-1">
                                            <select-compra-tipo v-model="tipo" label="Tipo"></select-compra-tipo>
                                        </div>
                                    </li>
                                    <li class="list-group-item pb-0 pl-2 pr-2" v-show="esFactura || esFacturaCambiaria">
                                        <div class="col-sm-12 mb-1">
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">S</span>
                                                </div>
                                                {!! Form::text('serie', null, ['class' => 'form-control','placeholder'=>'Serie']) !!}
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">N</span>
                                                </div>
                                                {!! Form::text('numero', null, ['class' => 'form-control','placeholder'=>'Número']) !!}
                                            </div>


                                        </div>

                                        <div class="col-12 mb-1" v-show="esFacturaCambiaria">
                                            <label for="recibo_de_caja" >Recibo de caja</label>
                                            {!! Form::text('recibo_de_caja', null, ['class' => 'form-control','placeholder'=>'Recibo de caja']) !!}
                                        </div>
                                    </li>



                                    {{-- <li class="list-group-item pb-0 pt-1  text-bold ">
                                        <div class="row ">

                                            <div class="col-sm-7 mb-1 py-0 m-0">
                                                Ingreso inmediato
                                                <input type="hidden" name="ingreso_inmediato" :value="ingreso_inmediato ? 1 : 0">
                                                <span class="float-right">
                                                     <toggle-button v-model="ingreso_inmediato"
                                                                    :sync="true"
                                                                    :labels="{checked: 'SI', unchecked: 'NO'}"
                                                                    :height="25"
                                                                    :width="50"
                                                                    :value="false"
                                                     />
                                                </span>
                                            </div>

                                        </div>

                                    </li> --}}
                                    <input type="hidden" name="ingreso_inmediato" value="0">

                                    <li class="list-group-item pb-0 ">
                                        <div class="row">
                                            <div class="col-sm-6 mb-1 ">
                                                {!! Form::label('fecha_documento', 'Fecha Documento:') !!}
                                                {!! Form::date('fecha_documento', hoyDb(), ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-sm-6 mb-1 ">
                                                {!! Form::label('fecha_ingreso', 'Fecha Ingreso:') !!}
                                                {!! Form::date('fecha_ingreso', hoyDb(), ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </li>

                                    <li class="list-group-item pb-0 ">
                                        <div class="row">
                                            <div class="col-sm-6 mb-1 ">
                                                {!! Form::label('orden_compra', 'Orden Compra:') !!}
                                                {!! Form::number('orden_compra', null, ['class' => 'form-control', 'required', 'v-model' => 'orden']) !!}
                                            </div>
                                        </div>
                                    </li>

                                    <!--            Observaciones
                                    ------------------------------------------------------------------------>
                                    <li class="list-group-item p-1">
                                        <div class="input-group">
            <textarea
                name="observaciones"
                id="observaciones"
                @focus="$event.target.select()"
                class="form-control"
                rows="2"
                placeholder="Observaciones"
            ></textarea>
                                        </div>
                                    </li>


                                    <li class="list-group-item pb-0 pl-2 pr-2">

                                        <div class="row">

                                            <div class="d-grid col-sm-5 mb-1">
                                                <a class="btn btn-outline-danger btn-block" data-bs-toggle="modal" href="#modal-cancel-compra">
                    <span data-toggle="tooltip" title="Cancelar compra">
                        <i class="fa fa-ban"></i>
                        Cancelar
                    </span>
                                                </a>
                                            </div>

                                            <div class="d-grid col-sm-7 mb-1">
                                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                                <button type="button"  class="btn btn-outline-success btn-block" @click="procesar()">
                                                    <i class="fa fa-check"></i>
                                                    Procesar
                                                </button>
                                            </div>

                                        </div>


                                    </li>
                                </ul>

                                <!-- Modal confirm -->
                                <div class="modal fade modal-info" id="modal-confirma-procesar">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">PROCESAR COMPRA!</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Seguro que desea continuar?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                                <button type="submit" class="btn btn-primary" name="procesar" value="1"  onclick="esperar()">SI</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <!-- Modal cancel -->
                                <div class="modal fade modal-warning" id="modal-cancel-compra">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <h4 class="modal-title">Cancelar compra!</h4>
                                            </div>
                                            <div class="modal-body">
                                                Seguro que desea cancelar la compra?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                                                <a href="{{route('compras.destroy',$temporal->id)}}" class="btn btn-danger">
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
                    unidad_solicita_id: @json( auth()->user()->unidad->id )
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

                orden: '',

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

                        this.detalles.forEach(detalle => {
                            detalle.cantidad_real = detalle.cantidad;
                            detalle.precio_real = detalle.precio;
                        });

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
                    if(this.totalitems>=1 && this.orden.length >= 5) {
                        $('#modal-confirma-procesar').modal('show');
                    }

                    if(this.orden.length == 0) {
                        iziTs('El número de orden es requerido');
                    }else if(this.orden.length < 5) {
                        iziTs('El número de orden debe tener al menos 5 caracteres');
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
                },
                async edit (detalle) {
                    this.loading = true;
                    try {
                        var res = await axios.patch(route('api.compra_detalles.update',detalle.id),detalle);
                        iziTs(res.data.message);

                        this.getItems()

                        this.loading = false;

                    }catch (e) {
                        notifyErrorApi(e);
                        this.loading = false;
                    }
                },
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
                        return this.tipo.id== @json(\App\Models\CompraTipo::FACTURA)
                    }

                    return false;
                },

                esFacturaCambiaria(){
                    if (this.tipo){
                        return this.tipo.id== @json(\App\Models\CompraTipo::FACTURA_CAMBIARIA)
                    }

                    return false;
                },

                detalle_editable() {
                    this.detalles.forEach(async detalle => {
                        detalle.sub_total = detalle.precio * detalle.cantidad;

                        if(detalle.cantidad_real != detalle.cantidad || detalle.precio_real != detalle.precio){
                            await this.edit(detalle)
                        }
                    });

                    return this.detalles
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
