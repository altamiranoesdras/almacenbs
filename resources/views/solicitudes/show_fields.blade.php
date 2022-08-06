<span class="float-right">
    {!! Form::label('solicitud_estado_id', 'Estado:') !!}
    <span class="badge badge-pill badge-info">{!! $solicitude->estado->nombre !!}</span>
</span>
<!-- Id Field -->
{!! Form::label('id', 'Id:') !!}
{!! $solicitude->id !!}<br>


<!-- Numero Field -->
{!! Form::label('numero', 'Código:') !!}
{!! $solicitude->codigo !!}<br>


<!-- Observaciones Field -->
{!! Form::label('justificacion', 'Justificacion:') !!}
{!! $solicitude->justificacion !!}<br>


<!-- User Id Field -->
{!! Form::label('user_id', 'Departamento solicita:') !!}
{!! $solicitude->unidad->nombre ?? '' !!}<br>


<!-- User Id Field -->
{!! Form::label('user_id', 'Solicitante:') !!}
{!! $solicitude->usuarioSolicita->name ?? '' !!}<br>


<!-- Created At Field -->
{!! Form::label('created_at', 'Fecha solicita:') !!}
{!! fechaLtn($solicitude->fecha_solicita) !!}<br>


@if ($solicitude->estaDespachada())

<!-- User Despacha Field -->
{!! Form::label('user_despacha', 'User Despacha:') !!}
{!! $solicitude->usuarioDespacha->name  ??  ''!!}<br>

<!-- Fecha Despacha Field -->
{!! Form::label('fecha_despacha', 'Despachada El:') !!}
{!! fechaLtn($solicitude->fecha_despacha) !!}<br>

@endif




<!-- Updated At Field -->
{{--{!! Form::label('updated_at', 'Actualizado el:') !!}--}}
{{--{!! $solicitude->updated_at !!}<br>--}}


<!-- Deleted At Field -->
{{--{!! Form::label('deleted_at', 'Borrado el:') !!}--}}
{{--{!! $solicitude->deleted_at !!}<br>--}}


