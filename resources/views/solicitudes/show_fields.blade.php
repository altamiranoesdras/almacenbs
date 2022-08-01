<span class="float-right">
    {!! Form::label('solicitud_estado_id', 'Estado:') !!}
    <span class="badge badge-pill badge-info">{!! $solicitude->estado->nombre !!}</span>
</span>
<!-- Id Field -->
{!! Form::label('id', 'Id:') !!}
{!! $solicitude->id !!}<br>


<!-- Numero Field -->
{!! Form::label('numero', 'Numero:') !!}
{!! $solicitude->numero !!}<br>


<!-- Observaciones Field -->
{!! Form::label('observaciones', 'Observaciones:') !!}
{!! $solicitude->observaciones !!}<br>


<!-- User Id Field -->
{!! Form::label('user_id', 'Solicitante:') !!}
{!! $solicitude->userSolicita->name !!}<br>


<!-- Created At Field -->
{!! Form::label('created_at', 'Creado el:') !!}
{!! $solicitude->created_at !!}<br>


@if ($solicitude->estado->id == \App\Models\SolicitudEstado::DESPACHADA)

<!-- User Despacha Field -->
{!! Form::label('user_despacha', 'User Despacha:') !!}
{!! $solicitude->userDespacha->name  ??  ''!!}<br>

<!-- Fecha Despacha Field -->
{!! Form::label('fecha_despacha', 'Despachada El:') !!}
{!! $solicitude->fecha_despacha !!}<br>

@endif




<!-- Updated At Field -->
{{--{!! Form::label('updated_at', 'Actualizado el:') !!}--}}
{{--{!! $solicitude->updated_at !!}<br>--}}


<!-- Deleted At Field -->
{{--{!! Form::label('deleted_at', 'Borrado el:') !!}--}}
{{--{!! $solicitude->deleted_at !!}<br>--}}


