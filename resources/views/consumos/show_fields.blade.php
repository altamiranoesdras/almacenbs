
<!-- Codigo Field -->
{!! Form::label('codigo', 'Codigo:') !!}
{!! $consumo->codigo !!}<br>


<!-- Estado Id Field -->
{!! Form::label('estado_id', 'Estado:') !!}
{!! $consumo->estado->nombre ?? '' !!}<br>


<!-- Unidad Id Field -->
{!! Form::label('unidad_id', 'Unidad:') !!}
{!! $consumo->unidad->nombre ?? '' !!}<br>


<!-- Bodega Id Field -->
{!! Form::label('bodega_id', 'Bodega:') !!}
{!! $consumo->bodega->nombre ?? '' !!}<br>


<!-- Usuario Crea Field -->
{!! Form::label('usuario_crea', 'Usuario Crea:') !!}
{!! $consumo->usuarioCrea->name ?? ''  !!}<br>


