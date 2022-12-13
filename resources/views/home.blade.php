@extends('layouts.app')

@section('title_page',__('Home'))

@push('css')

    <style>
        .card {
            min-width: 12rem !important;
            max-width: 12rem !important;
        }


        .badge-float {
            font-size: 10px;
            font-weight: 400;
            position: absolute;
            right: -10px;
            top: -3px;
        }
    </style>
@endpush


@section('content')


        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h1 class="m-0 text-dark">Bienvenido {{Auth::user()->name}}</h1>
                    </div><!-- /.col -->
                    <div class="col ">
                        <button class="btn btn-outline-primary float-right" :class="{'btn-outline-success' : editando}" @click="editando=!editando">
                            <i class="fa fa-edit" v-if="!editando"></i>
                            <i class="fa fa-save" v-if="editando"></i>
                            <span class="d-none d-sm-inline" v-if="!editando">
                            {{__('Edit Shortcuts')}}
                        </span>
                            <span class="d-none d-sm-inline" v-if="editando">
                            {{__('Finish edition')}}
                        </span>
                        </button>

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">


                    <div class="col-6 col-lg-3 py-2  text-center" v-for="shortcut in user.shortcuts" >

                        <div class="card" style="padding: 1rem">
                            <span class="badge badge-float bg-danger" v-if="editando"  >
                                 <button type="button" class="btn btn-sm" @click="removerAcceso(shortcut)" >
                                    <i class="fa fa-trash  text-white"></i>
                                </button>
                            </span>
                            <a :href="shortcut.ruta_evaluada"  style="color: black !important;">
                                <i class="fas fa-3x mb-1" :class="shortcut.icono_l+' '+colorIcono(shortcut.color)" ></i>
                                <h6 class="text-uppercase" v-text="shortcut.nombre"></h6>
                            </a>
                        </div>


                    </div>

                </div>

                <div class="row" v-show="editando">

                    <div class="col-12">
                        <hr>
                        <br>
                    </div>


                    <div class="col-6 col-lg-3 py-2 text-center" v-for="option in opcionesFiltradas">




                        <div class="card" style="padding: 1rem">
                            <span class="badge badge-float bg-success" v-if="editando"  >
                                 <button type="button" class="btn btn-sm" @click="agregarAcceso(option)" >
                                    <i class="fa fa-plus text-white"></i>
                                </button>
                            </span>
                            <a :href="option.ruta_evaluada"  style="color: black !important;">
                                <i class="fas fa-3x mb-1" :class="option.icono_l+' '+colorIcono(option.color)" ></i>
                                <h6 class="text-uppercase" v-text="option.nombre"></h6>
                            </a>
                        </div>

                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->



@endsection

@push('scripts')
    <script>
        const app = new Vue({
            el: '#contenido',
            created() {
                this.getData();
            },
            data: {
                user : @json(\App\Models\User::with(['shortcuts','options'])->find(auth()->user()->id)),
                editando: false,
            },
            methods: {
                colorIcono(clase){
                    if (clase){
                        return clase.replace('bg-','text-')
                    }
                },
                async getData(){


                    try {
                        let res = await axios.get(route("api.users.show",this.user.id));

                        this.user = res.data.data;
                        logI(res);

                    }catch (e) {
                        notifyErrorApi(e)
                    }
                },
                async agregarAcceso(option){

                    esperar();

                    try {
                        let res = await axios.post(route("api.users.add_shortcut",this.user.id), {'option' : option.id});

                        this.getData();

                        iziTs(res.data.message);

                        logI(res);

                    }catch (e) {
                        notifyErrorApi(e)
                    }

                    finEspera();
                },
                async removerAcceso(option){

                    esperar();
                    logI('remove shortcut',option);


                    try {
                        let res = await axios.post(route("api.users.remove_shortcut",this.user.id),{'option' : option.id});

                        iziTs(res.data.message);
                        this.getData();
                        logI(res);

                    }catch (e) {

                        notifyErrorApi(e)

                    }

                    finEspera();
                },
            },
            computed: {
                opcionesFiltradas(){
                    return this.user.options.filter( (opcion) => {
                        let esAcceso = this.user.shortcuts.find(shortcut => shortcut.id == opcion.id)

                        if (!esAcceso && opcion.ruta!=''){
                            return  opcion;
                        }

                    });
                }
            }

        });

        $(function(){



            $( ".sortable" ).sortable({
                update: function( event, ui ) {

                    var  opciones=[];
                    $(this).find('li').each(function (index,elemet) {
                        opciones.push($(this).attr('id'));
                    });

                }
            }).disableSelection();

        });
    </script>


@endpush


