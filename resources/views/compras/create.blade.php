@extends('layouts.app')

@section('titulo_pagina', 'Nuevo Ingreso de almacén')

@include('layouts.plugins.select2')
@include('layouts.xtra_condensed_css')
@include('layouts.plugins.bootstrap_fileinput')
{{--@push('sidebar_class','sidebar-collapse menu-collapsed')--}}

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

                <div class="card border-info">
                    {!! Form::model($temporal, ['url' => route('compras.update', $temporal->id), 'method' => 'patch','class'=>'esperar']) !!}
                    <div class="card-content collapse show">
                        <div class="card-body p-1">


                                <!-- Resumen -->
                                <div class="card border-secondary">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">
                                            Datos generales del ingreso
                                        </h5>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li>
                                                    <a data-action="collapse"><i data-feather="chevron-up"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-6 mb-1">
                                                    <select-proveedor
                                                        v-model="proveedor"
                                                        label="Proveedor"
                                                        ref="selectProveedor"
                                                    >

                                                    </select-proveedor>
                                                </div>

                                                <div class="col-3 mb-1">
                                                    <select-compra-tipo v-model="tipo" label="Tipo"></select-compra-tipo>
                                                </div>
                                                <div class="col-3 mb-1" v-show="esFactura || esFacturaCambiaria">
                                                    <label for="serie" >Serie</label>
                                                    <input type="text" name="serie" class="form-control" placeholder="Serie"
                                                           v-model="serie"
                                                           @input="serie = serie.toUpperCase()"
                                                           required>
                                                </div>

                                                <div class="col-3" v-show="esFactura || esFacturaCambiaria">
                                                    <label for="numero" >Número</label>
                                                    {!! Form::text('numero', null, ['class' => 'form-control','placeholder'=>'Número']) !!}
                                                </div>

                                                <div class="col-3 mb-1" v-show="esFacturaCambiaria">
                                                    <label for="recibo_de_caja" >Recibo de caja</label>
                                                    {!! Form::text('recibo_de_caja', null, ['class' => 'form-control','placeholder'=>'Recibo de caja']) !!}
                                                </div>

                                                {{--<div class="col-sm-7 mb-1 py-0 m-0">
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
                                                </div>--}}

                                                <div class="col-3 mb-1 ">
                                                    {!! Form::label('fecha_documento', 'Fecha Documento:') !!}
                                                    {!! Form::date('fecha_documento', hoyDb(), ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-3 mb-1 ">
                                                    {!! Form::label('fecha_ingreso', 'Fecha Ingreso:') !!}
                                                    {!! Form::date('fecha_ingreso', hoyDb(), ['class' => 'form-control','readonly']) !!}
                                                </div>
                                                <div class="col-3 mb-1 ">
                                                    {!! Form::label('orden_compra', 'Orden Compra:') !!}
                                                    {!! Form::number('orden_compra', null, ['class' => 'form-control', 'required']) !!}
                                                </div>



                                                <input type="hidden" name="ingreso_inmediato" value="0">
                                            </div>

                                            <div class="row">
                                                <div class="col mb-1">
                                                    <div class="input-group">
                                                        <textarea
                                                            name="observaciones"
                                                            id="observaciones"
                                                            @focus="$event.target.select()"
                                                            class="form-control"
                                                            rows="2"
                                                            placeholder="Observaciones"
                                                        >{{old('observaciones',$temporal->observaciones)}}</textarea>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- /. Resumen -->

                                <!-- Articulos -->
                                <div class="card border-secondary">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">
                                        Insumos / Detalles
                                        <small class="text-muted text-md">
                                            (<i class="fas fa-cubes"></i>Stock)
                                            (<i class="fas fa-archive"></i>Ubicacion)
                                        </small>
                                    </h5>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li>
                                                <a data-action="collapse"><i data-feather="chevron-up"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <div class="row mb-2">

                                            <div class="col-12 mb-1">
                                                <label for="item_id">Insumo</label>
                                                <select-items
                                                    api="{{route('api.items.index')}}"
                                                    tienda="1"
                                                    v-model="itemSelect"
                                                    ref="multiselect"
                                                >
                                                </select-items>
                                            </div>

                                            <div class="col-12 mb-1">
                                                <label for="unidad_solicita">Unidad Solicitante</label>
                                                <multiselect
                                                    v-model="editedItem.unidad_solicita"
                                                    :options="unidades"
                                                    label="text"
                                                    ref="selector_unidad"
                                                    track-by="id">

                                                </multiselect>
                                            </div>

                                            <div class="col-3 mb-1">
                                                <label for="fecha_vence">Fecha Vence</label>

                                                    <input
                                                        v-model="editedItem.fecha_vence"
                                                        type="date"
                                                        class="form-control"
                                                        @keydown.enter.prevent="siguienteCampo('cantidad')"
                                                    >
                                            </div>

                                            <div class="col-2 mb-1">
                                                <label for="cantidad">Cantidad</label>
                                                    <input
                                                        v-model="editedItem.cantidad"
                                                        type="number"
                                                        min="0" step="any"
                                                        class="form-control"
                                                        ref="cantidad"
                                                        @keydown.enter.prevent="siguienteCampo('precio')"
                                                    >
                                            </div>

                                            <div class="col-2 mb-1">
                                                <label for="precio">Precio</label>
                                                <input
                                                    v-model="editedItem.precio"
                                                    type="number"
                                                    min="0" step="any"
                                                    ref="precio"
                                                    class="form-control"
                                                    placeholder="Precio compra"
                                                    @keydown.enter.prevent="siguienteCampo('agregar')"
                                                >
                                            </div>

                                            <div class="col-2">
                                                <label for="agregar">&nbsp;</label>
                                                <div>
                                                    <button type="button" ref="agregar" class="btn btn-success" @click.prevent="save" :disabled="loading" >
                                                    <span v-show="loading" >
                                                        <i class="fa fa-spinner fa-spin"></i>
                                                    </span>
                                                        <span v-show="!loading">
                                                        <i class="fa fa-plus"></i>
                                                    </span>
                                                        <span v-text="labelBotonDetalle"></span>
                                                    </button>
                                                </div>
                                            </div>

                                            {{--Boton para cancelar edicion--}}
                                            <div class="col-2" v-show="detalleEnEdicion">
                                                <label for="agregar">&nbsp;</label>
                                                <div>
                                                    <button type="button" class="btn btn-secondary" @click.prevent="editedItem = Object.assign({}, defaultItem); abreSelectorItems()" :disabled="loading || editedItem.id===0" >
                                                        <i class="fa fa-times"></i>
                                                        Cancelar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                            <table  class="table table-bordered table-sm table-striped" id="tablaDetalle" style="margin-bottom: 2px">
                                                <thead>
                                                <tr class="text-sm">
                                                    <td width="50%">Producto</td>
                                                    <td width="20s%">Unidad Solicitante</td>
                                                    <td>Precio</td>
                                                    <td>Cantidad</td>
                                                    <td>Fecha Vence</td>
                                                    <td>Subtotal</td>
                                                    <td width="10%">Acciones</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-if="detalles.length==0">
                                                    <td colspan="7"><span class="help-block text-center">No se ha agregado ningún artículo</span></td>
                                                </tr>
                                                <tr v-for="detalle in detalles" class="text-sm">
                                                    <td v-text="detalle.item.text"></td>
                                                    <td v-text="getNombre(detalle)"></td>

                                                    <td v-text="dvs + nfp(detalle.precio)"></td>
                                                    <td v-text="nf(detalle.cantidad)"></td>
                                                    <td v-text="detalle.fecha_vence_latina"></td>
                                                    <td v-text="dvs + nfp(detalle.sub_total)"></td>
                                                    <td width="10px">
                                                        <button type="button" class="btn btn-outline-info btn-sm" @click="editItem(detalle)">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" class='btn btn-outline-danger btn-sm' @click="deleteItem(detalle)" :disabled="(idEliminando===detalle.id)">
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
                                <!-- /. Articulos -->

                        </div>
                        <div class="card-footer">
                            <div class="row">

                                <div class="d-grid col-sm-4 mb-1">
                                    <a class="btn btn-outline-danger btn-block" data-bs-toggle="modal" href="#modal-cancel-compra">
                                    <span data-toggle="tooltip" title="Cancelar compra">
                                        <i class="fa fa-ban"></i>
                                        Cancelar
                                    </span>
                                    </a>
                                </div>

                                <div class="d-grid col-sm-4 mb-1">
                                    <button type="submit" class="btn btn-outline-primary btn-block" @click="esperar()">
                                        <i class="fa fa-save"></i>
                                        Guardar
                                    </button>
                                </div>

                                <div class="d-grid col-sm-4 mb-1">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <button type="button" class="btn btn-outline-success btn-block" @click="procesar()">
                                        <i class="fa fa-check"></i>
                                        Procesar
                                    </button>
                                </div>

                            </div>

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
                                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">NO</button>
                                            <button type="submit" class="btn btn-primary" name="procesar" value="1">SI</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    {!! Form::close() !!}



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
                // this.abreSelectorItems();
            },
            created: function() {
                this.getItems();
            },
            data: {
                temporal : @json($temporal),
                detalles: [],

                itemSelect: null,

                unidades: @json(\App\Models\RrhhUnidad::areas()->solicitan()->get()),

                editedItem: {
                    id : 0,
                    compra_id : @json($temporal->id),
                },
                defaultItem: {
                    id : 0,
                    compra_id : @json($temporal->id),
                    unidad_solicita: null,
                    item_id: '',
                    cantidad: 0,
                    fecha_vence: '',
                    precio: 0,
                },
                loading: false,
                idEliminando: '',
                ingreso_inmediato: false,
                proveedor: @json($temporal->proveedor ?? Proveedor::find(old('proveedor_id')) ?? null),
                tipo: @json($temporal->tipo ?? CompraTipo::find(old('tipo_id')) ?? CompraTipo::find(CompraTipo::FACTURA)),
                serie: @json($temporal->serie ?? old('serie') ?? ''),
                descuento: @json($temporal->descuento ?? old('descuento') ?? 0),
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
                getNombre(detalle,relacion='unidad_solicitante'){

                    return detalle[relacion] ? detalle[relacion].text : '' ;
                },

                editItem (detalle) {
                    this.editedItem = Object.assign({}, detalle);
                    this.editedItem.unidad_solicita = detalle.unidad_solicitante;
                    this.itemSelect = detalle.item;

                    //esperar a que Vue actualice el DOM para volver asignar el precio del detalle y no del item
                    this.$nextTick(() => {
                        this.editedItem.precio = detalle.precio;
                    });

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
                        this.editedItem.unidad_solicita_id = this.getId(this.editedItem.unidad_solicita);
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

                    // 1) Validación de items
                    if (this.totalitems == 0) {
                        alertWarning('Debe agregar al menos un artículo');
                        return;
                    }

                    // 2) Validación nativa HTML5 de TODO el formulario
                    // this.$el es el contenedor del componente; busca el <form>
                    const form = this.$el.querySelector('form');

                    // Asegúrate de que los campos condicionales ya tengan el required correcto
                    // (ya lo hicimos con v-bind:required arriba)

                    if (!form.checkValidity()) {
                        // Muestra mensajes de error del navegador y enfoca el primer inválido
                        form.reportValidity();
                        return;
                    }

                    // 3) Si todo está OK, muestra el modal de confirmación
                    const modalEl = document.getElementById('modal-confirma-procesar');
                    // Bootstrap 5 API (evita jQuery si no es necesario)
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();
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
                abreSelectorProveedores () {
                    this.proveedor = null;
                    this.$refs.selectProveedor.$refs.multiselect.$el.focus();
                },
                abrirSelectorUnidad() {
                    // Verifica que exista la referencia y el método open
                    if (this.$refs.selector_unidad && this.$refs.selector_unidad.$el) {
                        // Vue Multiselect tiene un método interno para abrir el dropdown
                        this.$refs.selector_unidad.activate();
                    }
                }
            },

            computed: {
                detalleEnEdicion () {
                    return this.editedItem.id !== 0;
                },
                labelBotonDetalle () {
                    return this.editedItem.id === 0 ? 'Agregar ' : 'Actualizar '
                },
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

            },
            watch:{
                itemSelect (item) {
                    if (item){
                        this.editedItem.precio = item.precio_compra;
                        this.editedItem.item_id = item.id;
                        //$(this.$refs.cantidad).focus().select();
                        this.abrirSelectorUnidad();
                    }else{
                        this.nuevoDetalle = Object.assign({}, this.itemDefault);
                    }
                },
                'editedItem.unidad_solicita'(nuevoValor, valorAnterior) {
                    if (nuevoValor !== valorAnterior) {
                        $(this.$refs.cantidad).focus().select();
                    }
                }
            }
        });
    </script>
@endpush
