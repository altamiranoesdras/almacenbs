<!-- Codigo Field -->
{!! Form::label('codigo', 'Codigo:') !!}
{!! $activoSolicitud->codigo !!}<br>

<!-- Correlativo Field -->
{!! Form::label('correlativo', 'Correlativo:') !!}
{!! $activoSolicitud->correlativo !!}<br>

<!-- Colaborador Origen Field -->
{!! Form::label('colaborador_origen', 'Colaborador Origen:') !!}
{!! $activoSolicitud->colaboradorOrigen->nombre_completo !!}<br>

<!-- Unidad Origen Field -->
{!! Form::label('unidad_origen', 'Unidad Origen:') !!}
{!! $activoSolicitud->unidadOrigen->nombre !!}<br>

<!-- Colaborador Destino Field -->
{!! Form::label('colaborador_destino', 'Colaborador Destino:') !!}
{!! $activoSolicitud->colaboradorDestino->nombre_completo !!}<br>

<!-- Unidad Destino Field -->
{!! Form::label('unidad_destino', 'Unidad Destino:') !!}
{!! $activoSolicitud->unidadDestino->nombre !!}<br>

<!-- Usuario Autoriza Field -->
{!! Form::label('usuario_autoriza', 'Usuario Autoriza:') !!}
{!! $activoSolicitud->usuarioAutoriza->name !!}<br>

<!-- Usuario Inventario Field -->
{!! Form::label('usuario_inventario', 'Usuario Inventario:') !!}
{!! $activoSolicitud->usuario_inventario !!}<br>

<!-- Observaciones Field -->
{!! Form::label('observaciones', 'Observaciones:') !!}
{!! $activoSolicitud->observaciones !!}<br>

<!-- Estado Id Field -->
{!! Form::label('estado_id', 'Estado Id:') !!}
{!! $activoSolicitud->estado->nombre !!}<br>
