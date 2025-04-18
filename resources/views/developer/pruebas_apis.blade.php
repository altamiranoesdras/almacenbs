@extends('layouts.app')

@section('titulo_pagina', 'Prueba Apis')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Prueba Apis</h2>
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

    <div class="content-body" id="pruebaApi">

        <div class="row">
            <div class="col-lg-12 mb-1">
                <div class="card shadow-none bg-transparent border-info">
                    <div class="card-body">
                        <form action="" @submit.prevent="runApi()">

                            <div class="row">

                                <div class="col-sm-3 mb-1">
                                    <label for="">Método envío</label>
                                    <multiselect v-model="metodoSeleccionado"
                                                 :options="metodos"
                                                 :multiple="false"
                                                 :close-on-select="true"
                                                 placeholder="Seleccione uno..."
                                                 label="nombre"
                                                 track-by="valor">

                                    </multiselect>
                                </div>
                                <div class="col-sm-9 mb-1">
                                    {!! Form::label('api', 'API / URL:') !!}

                                    <div class="input-group">

                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    {{ url('/') }}/
                                                </span>
                                        </div>

                                        <input type="text" v-model="uri" class="form-control" placeholder="ej: api/users">

                                        <span class="input-group-append">
                                            <button class="btn btn-success" type="submit">
                                                <i class="fa fa-play"></i>
                                                 Probar
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-12 mb-1">
                                    {!! Form::label('params', 'Parametros:') !!}
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Clave</th>
                                            <th>Valor</th>
                                            <th>Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(parametro,index) in parametros">
                                            <td>
                                                <input type="text" v-model="parametro.key" @keyup="agregarParametro()" class="form-control" placeholder="ej: id">
                                            </td>
                                            <td>
                                                <input type="text" v-model="parametro.value" class="form-control" placeholder="ej: 1">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" @click="eliminarParametro(index)" v-show="index>0">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>


                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->

            <div class="col-sm-12">
                <div class="card shadow-none bg-transparent border-success">
                    <div class="card-header">
                        <h3 class="card-title">Resultado</h3>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" >
                            <pre>
                                <p >@{{ result }}</p>
                            </pre>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>

    </div>

@endsection




@push('scripts')
<script>
    const vmPruebaApis = new Vue({
        el: '#pruebaApi',
        name: 'pruebaApi',
        created() {

        },
        data: {
            metodoSeleccionado : {nombre: 'GET', valor: 'get'},

            baseUrl : '{{ url('/')}}',
            uri : 'api/users',

            parametros: [
                {key: '', value: ''},
            ],

            parametroBacio: {
                key: '',
                value: ''
            },

            result : '',

            metodos : [
                {nombre: 'GET', valor: 'get'},
                {nombre: 'POST', valor: 'post'},
                {nombre: 'PUT', valor: 'put'},
                {nombre: 'PATCH', valor: 'patch'},
                {nombre: 'DELETE', valor: 'delete'},
            ],


        },
        methods: {
            async runApi(){

                console.log(this.metodoSeleccionado.valor, this.uri, this.parametrosFormateados);

                if (this.uri.length == 0){
                    alertWarning("Debe ingresar una url");
                    return;
                }

                var url = this.baseUrl+'/'+this.uri;

                esperar();

                switch (this.metodoSeleccionado.valor) {
                    case 'post':

                        try {

                            this.result = await axios.post(url, this.parametrosFormateados);

                        }catch (e) {

                            this.result = e.response;
                            notifyErrorApi(e)
                        }

                        break;
                    case 'get':
                        try {

                            this.result = await axios.get(url, {params: this.parametrosFormateados});
                        }catch (e) {
                            this.result = e.response;
                            notifyErrorApi(e);
                        }

                        break;
                    case 'put':

                        try {

                            this.result = await axios.put(url, this.parametrosFormateados);

                        } catch (e) {
                            this.result = e.response;
                            notifyErrorApi(e);
                        }

                        break;
                    case 'patch':
                        try {

                            this.result = await axios.patch(url, this.parametrosFormateados);

                        } catch (e) {
                            this.result = e.response;
                            notifyErrorApi(e);
                        }
                        break;
                    case 'delete':
                        try {

                            this.result = await axios.delete(url, {params: this.parametrosFormateados});

                        } catch (e) {
                            this.result = e.response;
                            notifyErrorApi(e);
                        }
                        break;
                    default:
                        alertWarning("Metodo no soportado")
                        break;

                }

                finEspera();

            },

            agregarParametro(){

                if (this.validaUltimoParametroTieneValor()){
                    const nuevo = Object.assign({}, this.parametroBacio);

                    this.parametros.push(nuevo);
                }
            },
            eliminarParametro(index){
                this.parametros.splice(index,1);
            },
            validaUltimoParametroTieneValor(){

                var ultimo = this.parametros[this.parametros.length - 1];

                var tieneValor = false;


                if(ultimo.key.length > 0 || ultimo.value.length > 0){
                    tieneValor = true;
                }

                console.log(ultimo, tieneValor);

                return tieneValor;
            }
        },
        computed: {
            parametrosFormateados(){
                var params = this.parametros;

                var paramsFormateados = {};

                params.forEach(function (param) {
                    if(param.key.length > 0 && param.value.length > 0){
                        paramsFormateados[param.key] = param.value;
                    }
                });

                return paramsFormateados;
            }

        }

    });
</script>
@endpush

