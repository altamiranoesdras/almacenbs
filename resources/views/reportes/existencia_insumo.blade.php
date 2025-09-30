@extends('layouts.app')

@include('layouts.plugins.bootstrap_datetimepicker')
@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('htmlheader_title')
    EXISTENCIA POR INSUMO
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">EXISTENCIA POR INSUMO</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content-body" id="root">
        <div class="container-fluid">
            @include('layouts.partials.request_errors')
            <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Código Insumo</th>
                                                <th>Cóodigo Presentacion</th>
                                                <th>Presentacion</th>
                                                <th>Nombre Insumo</th>
                                                <th>Existencia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr v-for="item in items">
                                                <td><span v-text="item.id"></span></td>
                                                <td><span v-text="item.codigo_insumo"></span></td>
                                                <td><span v-text="item.codigo_presentacion"></span></td>
                                                <td><span v-text="item.presentacion?.nombre"></span></td>
                                                <td><span v-text="item.nombre"></span></td>
                                                <td>
                                                    <span v-text="item.stock_total.toLocaleString('es-ES')"></span>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@push('scripts')
    <script >
        vm = new Vue({
            el: '#root',
            mounted() {
                // this.procesar();
            },
            created: function() {
                this.items = @json($items)
            },
            data: {
                items: {}
            },
            methods: {
                // procesar: function () {
                //     if(this.totalitems>=1){
                //         $('#modal-confirma-procesar').modal('show');
                //     }else {
                //         iziTe('No hay ningún artículo en esta requisición')
                //     }
                // }
            },
            computed: {
                // dvs: function(){
                //     return @json(dvs())
                // },
            },
            watch:{
                // itemSelect (item) {
                //     if (item){
                //         this.editedItem.precio = item.precio_compra;
                //         this.editedItem.item_id = item.id;
                //         $(this.$refs.cantidad_solicitada).focus().select();
                //     }else{
                //         this.nuevoDetalle = Object.assign({}, this.itemDefault);
                //     }
                // },
            }
        });
    </script>
@endpush
