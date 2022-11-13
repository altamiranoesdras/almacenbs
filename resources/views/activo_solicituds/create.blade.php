@extends('layouts.app')

@section('title_page',__('New Activo Solicitud'))

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
                        Nueva Solicitud Activos
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content" id="activoSolicitudCrear">
        <div class="container-fluid">

            @include('layouts.errores')

            {!! Form::model($temporal, ['route' => ['activoSolicitudes.update', $temporal->id], 'method' => 'patch', 'class' => 'esperar']) !!}
                <div class="row mt-2">

                    <!-- Activos -->
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <div class="card card-warning card-outline">
                            <div class="card-header with-border py-2">
                                <h3 class="card-title">
                                    <strong>Activos</strong>
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
                                <div class="form-group mb-4">
                                    <select-items
                                        api="{{route('api.activos.index')}}"
                                        tienda="1"
                                        v-model="itemSelect"
                                        ref="multiselect"
                                    >
                                    </select-items>
                                </div>

                                <div class="row pt-1">

                                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <multiselect v-model="editedItem.estado_del_bien" :options="estadoBienList" label="nombre" placeholder="Estado del Bien ..." >
                                        </multiselect>
                                    </div>

                                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <textarea class="form-control" v-model="editedItem.observaciones" placeholder="Observacion"></textarea>
                                    </div>

                                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <select-activo-solicitud-tipo v-model="editedItem.solicitud_tipo_id" label="Solicitud Tipo" :mostrarTitulo="false" ></select-activo-solicitud-tipo>
                                    </div>

                                </div>

                                <div class="row float-right">
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <button type="button" ref="agregar" class="btn btn-success" @click.prevent="save" :disabled="loading" >
                                            <span v-show="loading" >
                                                <i class="fa fa-spinner fa-spin"></i>
                                            </span>
                                            <span v-show="!loading" class="glyphicon glyphicon-plus"></span>
                                            Agregar
                                        </button>
                                    </div>
                                </div>

                                <div id="div-info-item"></div>

                                @include('activo_solicituds.tabla_det_vue')
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

                                @include('activo_solicituds.fields')

                            </div>
                        </div><!-- /.row -->
                    </div>
                    <!-- /. Resumen -->

                </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@push('scripts')
    <!--    Scripts compras
------------------------------------------------->
    <script >
        vm = new Vue({
            el: '#activoSolicitudCrear',
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
                    solicitud_id : @json($temporal->id),
                },
                defaultItem: {
                    id : 0,
                    solicitud_id : @json($temporal->id),
                    activo_id: '',
                },
                loading: false,

                idEliminando: '',

                proveedor: @json($compra->proveedor ?? \App\Models\Proveedor::find(old('proveedor_id')) ?? null),

                colaborador_origen: null,
                colaborador_destino: null,
                unidad_origen: null,
                unidad_destino: null,

                estadoBienList: [
                    {
                        nombre: 'Bueno Estado',
                        codigo: 'B'
                    },
                    {
                        nombre: 'Regular Estado',
                        codigo: 'R'
                    },
                    {
                        nombre: 'Mal Estado u Obsoleto',
                        codigo: 'M'
                    }
                ],

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
                getCodigo(item){
                    if(item)
                        return item.codigo;

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

                        let params= { params: {solicitud_id: @json($temporal->id) } }

                        var res = await axios.get(route('api.activo_solicitud_detalles.index'),params);

                        this.detalles  = res.data.data;

                    }catch (e) {
                        notifyErrorApi(e);
                    }

                    this.loading = false;


                },
                async save () {

                    this.loading = true;


                    try {

                        this.editedItem.activo_id = this.getId(this.itemSelect);
                        this.editedItem.activo_tipo_id = this.itemSelect.tipo_id;
                        this.editedItem.solicitud_tipo_id = @json(\App\Models\ActivoSolicitudTipo::TIPO_1);
                        this.editedItem.estado_del_bien = this.getCodigo(this.editedItem.estado_del_bien);
                        const data = this.editedItem;

                        if(this.editedItem.id === 0){

                            var res = await axios.post(route('api.activo_solicitud_detalles.store'),data);

                        }else {

                            var res = await axios.patch(route('api.activo_solicitud_detalles.update',this.editedItem.id),data);

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
                        let res = await  axios.delete(route('api.activo_solicitud_detalles.destroy',item.id))
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

                    $.each(this.detalles,function (i,det) {
                        t+=det.sub_total;
                    });

                    return t;
                },

                totalitems: function () {
                    var t=0;
                    $.each(this.detalles,function (i,det) {
                        t+=1;
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
                ingreso_inmediato(val){
                    if(val){
                        this.fecha_ingreso_plan = '{{hoyDb()}}'
                    }

                },
                itemSelect (item) {

                    if (item){

                        this.editedItem.precio = item.precio_compra;
                        this.editedItem.item_id = item.id;
                        $(this.$refs.cantidad).focus().select();
                    }else{
                        this.nuevoDetalle = Object.assign({}, this.itemDefault);
                    }
                },
                colaborador_origen(val) {
                    if (val) {
                        this.unidad_origen = val.unidad_id;
                    }
                },
                colaborador_destino(val) {
                    if (val) {
                        this.unidad_destino = val.unidad_id;
                    }
                },
            }

        });
    </script>
@endpush

