@extends('layouts.app')

@include('layouts.xtra_condensed_css')
@include('layouts.plugins.datatables_reportes')
@section('titulo_pagina', "Reporte Stock")


@section('htmlheader_title')
    Reporte Stock
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">Reporte Stock</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['route' => 'reportes.stock','method' => 'get']) !!}
                            <div class="form-row">


                                <div class="form-group col-sm-6">
                                    {!! Form::label('bodega_id','Sede / Bodega:') !!}
                                    {!! Form::select('bodega_id', select(\App\Models\Bodega::class,'nombre','id'), $bodega_id ?? null, ['id'=>'bodegas','class' => 'form-control']) !!}
                                </div>

                                <div class="form-group col-sm-6">
                                    {!! Form::label('item_id','Insumo:') !!}
                                    {!!
                                        Form::select(
                                            'item_id',
                                            select(\App\Models\Item::whereHas('stocks'),'texto_kardex','id',null,null)
                                            , request()->item_id ?? null
                                            , ['id'=>'items','class' => 'form-control','multiple','style'=>'width: 100%']
                                        )
                                    !!}
                                </div>

                                <div class="form-group col-sm-6">
                                    {!! Form::label('renglon','Renglón:') !!}
                                    {!! Form::select('renglon', select(\App\Models\Renglon::class,'text','id','Ver Todos'), $renglon, ['id'=>'categorias','class' => 'form-control']) !!}
                                </div>

                                <div class="form-group col-sm-2 ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stock" id="radio_stock1" value="con_stock" {{ $stock=='con_stock'  ? 'checked' : '' }}>
                                        <label class="form-check-label" for="radio_stock1">Con Stock</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stock" id="radio_stock2" value="sin_stock" {{ $stock=='sin_stock'  ? 'checked' : '' }}>
                                        <label class="form-check-label" for="radio_stock2" >Sin Stock</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stock" id="radio_stock3" value="todos" {{ $stock=='todos'  ? 'checked' : '' }}>
                                        <label class="form-check-label" for="radio_stock3">todos</label>
                                    </div>
                                </div>


                                <div class="form-group col-sm-2 ">
                                    {!! Form::label('buscar','&nbsp;') !!}
                                    <div>
                                        <button class="btn btn-success" id="buscar" type="submit" name="buscar"  value="1">
                                            <i class="fa fa-search"></i> Consultar
                                        </button>
                                    </div>
                                </div>

                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->


            <!-- /.row -->
            @if(isset($buscar))
                @if($stocks )
                    <div class="row">
                        <div class="col-12 ">
                            <div class="card card-primary card-outline card-outline-tabs">
                              <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                  <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">
                                        Desglosado
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">
                                        Unificado
                                    </a>
                                  </li>
                                </ul>
                              </div>
                              <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">


                                      <form action="{{route('reportes.stock.actualizar')}}" method="post">
                                            @csrf
                                            @method('patch')



                                      <div class="table-responsive">
                                          <table class="table table-bordered table-hover table-striped table-xtra-condensed" id="tabla-desglosado">
                                              <thead>
                                              <tr class="text-sm">
                                                  {{--                                                <th>id</th>--}}
                                                  <th>Bodega</th>
                                                  <th>Articulo</th>
                                                  <th>Código Insumo</th>
                                                  <th>Código Presentación</th>
                                                  <th>Renglón</th>
                                                  <th>U/M</th>
                                                  <th>Fecha Vence</th>
                                                  <th>Stock</th>
                                                  <th data-toggle="tooltip" title="Precio de Compra Unitario">
                                                      Precio C/U
                                                  </th>
                                                  <th data-toggle="tooltip" title="Sub Total Compras">
                                                      SubTotal
                                                  </th>
                                              </tr>
                                              </thead>
                                              <tbody>

                                              @foreach($stocks as $det)
                                                  <tr class="text-sm  ">
                                                      {{--                                                    <td>{{$det->id}}</td>--}}
                                                      <td>{{$det->bodega->nombre}}</td>
                                                      <td>{{$det->item->texto_principal}}</td>
                                                      <td>{{$det->item->codigo_insumo}}</td>
                                                      <td>{{$det->item->codigo_presentacion}}</td>
                                                      <td>{{$det->item->renglon->numero ?? ''}}</td>
                                                      <td>{{$det->item->unimed->nombre ?? ''}}</td>
                                                      <td>
                                                          <!-- campo fecha vence -->
                                                          <input type="date" class="form-control form-control-sm" name="fechas_vence[{{$det->id}}]"
                                                                 value="{{fechaIngles($det->fecha_vence)}}">

                                                      </td>
                                                      <td>{{nf($det->cantidad,0)}}</td>
                                                      <td>{{ dvs().nfp($det->precio_compra)}}</td>
                                                      <td>{{ dvs().nfp($det->sub_total)}}</td>
                                                  </tr>
                                              @endforeach
                                              </tbody>
                                              <tfoot>
                                              <tr class="text-sm">
                                                  <th >Total</th>
                                                  <th></th>
                                                  <th></th>
                                                  <th></th>
                                                  <th></th>
                                                  <th></th>
                                                  <th></th>
                                                  <th>{{nf($stocks->sum('cantidad'))}}</th>
                                                  <th></th>
                                                  <th>{{ dvs().nfp($stocks->sum('sub_total'))}}</th>
                                                  <th></th>
                                              </tr>
                                              </tfoot>
                                          </table>
                                      </div>

                                          <div class="form-row">

                                              <!-- Boton Cancelar -->
                                                <div class="form-group col-sm-6 text-left">
                                                    <a href="{{route('reportes.stock')}}" class="btn btn-secondary">
                                                        <i class="fa fa-times"></i> Cancelar
                                                    </a>
                                                </div>

                                              <!-- Boton Guardar -->
                                              <div class="form-group col-sm-6 text-right">
                                                  <button class="btn btn-success" type="submit">
                                                      <i class="fa fa-save"></i> Guardar
                                                  </button>
                                              </div>
                                          </div>


                                      </form>



                                  </div>
                                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                      <table class="table table-bordered table-hover table-striped table-xtra-condensed" id="tabla-unificado">
                                          <thead>
                                          <tr class="text-sm">
                                              {{--                                                <th>id</th>--}}
                                              <th>Bodega</th>
                                              <th>Articulo</th>
                                              <th>Código Insumo</th>
                                              <th>Código Presentación</th>
                                              <th>Renglón</th>
                                              <th>U/M</th>
                                              <th>Stock</th>
                                          </tr>
                                          </thead>
                                          <tbody>

                                          @foreach($items ?? [] as $det)
                                              <tr class="text-sm  ">
                                                  {{--                                                    <td>{{$det->id}}</td>--}}
                                                  <td>{{ \App\Models\Bodega::find(request()->bodega_id)->nombre ?? "TODAS" }}</td>
                                                  <td>{{$det->texto_principal}}</td>
                                                  <td>{{$det->codigo_insumo}}</td>
                                                  <td>{{$det->codigo_presentacion}}</td>
                                                  <td>{{$det->renglon->numero ?? ''}}</td>
                                                  <td>{{$det->unimed->nombre ?? ''}}</td>
                                                  <td>
                                                  @if(request()->bodega_id)
                                                      {{nf($det->stock_bodega,0)}}
                                                  @else
                                                    {{nf($det->stocks->sum('cantidad'),0)}}
                                                  @endif
                                                  </td>
                                              </tr>
                                          @endforeach
                                          </tbody>
                                          <tfoot>
                                          <tr class="text-sm">
                                              <th >Total</th>
                                              <th></th>
                                              <th></th>
                                              <th></th>
                                              <th></th>
                                              <th></th>
                                              <th>
                                                  @if(request()->bodega_id)
                                                      {{nf($items->sum('stock_bodega'),0)}}
                                                  @else
                                                    {{nf($items->sum(function ($item){ return $item->stocks->sum('cantidad'); }) )}}
                                                  @endif

                                              </th>
                                          </tr>
                                          </tfoot>
                                      </table>
                                  </div>
                                </div>
                              </div>
                              <!-- /.card -->
                            </div>
                        </div>

                    </div>
                @else
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>No hay resultados para su busqueda</strong>
                    </div>
                @endif
            @endif
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@include('layouts.plugins.select2')

@push('scripts')

<!--    Scripts reporte de stock datatable
------------------------------------------------->
<script>
    $(function () {

        $("#items").select2({
            placeholder: 'Seleccione uno...',
            language: "es",
            maximumSelectionLength: 1,
            allowClear: true
        });

        $('#tabla-desglosado').DataTable( {
            dom: 'Brtip',
            paginate: false,
            ordering: true,
            language: {
                "url": "{{asset('js/SpanishDataTables.json')}}"
            },
            buttons: [
                {extend : 'copy', 'text' : '<i class="fa fa-copy"></i> <span class="d-none d-sm-inline">Copiar</span>'},
                {extend : 'csv', 'text' : '<i class="fa fa-file-excel"></i> <span class="d-none d-sm-inline">CSV</span>'},
                {extend : 'excel', 'text' : '<i class="fa fa-file-excel"></i> <span class="d-none d-sm-inline">Excel</span>'},
                {extend : 'pdf', 'text' : '<i class="fa fa-file-pdf"></i> <span class="d-none d-sm-inline">PDF</span>'},
                {extend : 'print', 'text' : '<i class="fa fa-print"></i> <span class="d-none d-sm-inline">Imprimir</span>'},
            ],
            "order": []
        } );

        $('#tabla-unificado').DataTable( {
            dom: 'Brtip',
            paginate: false,
            ordering: true,
            language: {
                "url": "{{asset('js/SpanishDataTables.json')}}"
            },
            buttons: [
                {extend : 'copy', 'text' : '<i class="fa fa-copy"></i> <span class="d-none d-sm-inline">Copiar</span>'},
                {extend : 'csv', 'text' : '<i class="fa fa-file-excel"></i> <span class="d-none d-sm-inline">CSV</span>'},
                {extend : 'excel', 'text' : '<i class="fa fa-file-excel"></i> <span class="d-none d-sm-inline">Excel</span>'},
                {extend : 'pdf', 'text' : '<i class="fa fa-file-pdf"></i> <span class="d-none d-sm-inline">PDF</span>'},
                {extend : 'print', 'text' : '<i class="fa fa-print"></i> <span class="d-none d-sm-inline">Imprimir</span>'},
            ],
            "order": []
        } );

    })
</script>
@endpush


