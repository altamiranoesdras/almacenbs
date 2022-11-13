<!-- Responsable Id Field -->
{!! Form::label('colaborador_id', 'Responsable:') !!}
{!! $activoTarjeta->responsable->nombre_completo !!}<br>

<!-- Responsable Id Field -->
{!! Form::label('Departamento', 'Departamento:') !!}
{!! $activoTarjeta->responsable->unidad->nombre !!}<br>

{!! Form::label('puesto', 'Puesto:') !!}
{!! $activoTarjeta->responsable->puesto->nombre ?? ''!!}<br>


<!-- Codigo Field -->
{!! Form::label('codigo', 'Codigo Interno:') !!}
{!! $activoTarjeta->codigo_interno !!}<br>

<!-- Codigo Field -->
{!! Form::label('codigo', 'Codigo Sistema:') !!}
{!! $activoTarjeta->codigo !!}<br>



<div class="card card-outline card-success">
    <div class="card-header">
        <h3 class="card-title">Bienes</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-sm" >
            <thead>
            <tr class="py-0">
                <th >NO.</th>
                <th >DESCRIPCIÓN DEL BIEN</th>
                <th >NO. DE BIEN</th>
                <th >ALZA</th>
                <th >BAJA</th>
                <th >SALDO</th>
            </tr>
            </thead>
            <tbody >
            @php
                $saldo = 0;
            @endphp
            @foreach($activoTarjeta->detalles as $i => $det)
                @php
                    if ($det->valor_alza){
                       $saldo += $det->valor_alza;
                    }

                    if ($det->valor_baja){
                       $saldo -= $det->valor_baja;
                    }

                @endphp
                <tr style="">
                    <td>
                        {{$i+1}}
                    </td>
                    <td>
                        {{$det->activo->descripcion}}
                    </td>
                    <td>
                        {{$det->activo->codigo_inventario}}
                    </td>
                    <td>
                        {{dvs().nfp($det->valor_alza)}}
                    </td>
                    <td>
                        {{dvs().nfp($det->valor_baja)}}
                    </td>
                    <td>
                        {{dvs().nfp($saldo)}}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
