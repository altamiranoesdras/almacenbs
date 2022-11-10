<!-- Codigo Inventario Field -->
{!! Form::label('codigo_inventario', 'Codigo Inventario:') !!}
{!! $activo->codigo_inventario !!}<br>


<!-- Folio Field -->
{!! Form::label('folio', 'Folio:') !!}
{!! $activo->folio !!}<br>


<!-- Descripcion Field -->
{!! Form::label('descripcion', 'Descripcion:') !!}
{!! $activo->descripcion !!}<br>


<!-- Valor Field -->
{!! Form::label('valor', 'Valor:') !!}
{!! $activo->valor !!}<br>


<!-- Fecha Registra Field -->
{!! Form::label('fecha_registro', 'Fecha Registra:') !!}
{!! fechaLtn($activo->fecha_registro) !!}<br>


<!-- Tipo Id Field -->
{!! Form::label('tipo_id', 'Tipo:') !!}
{!! $activo->tipo->nombre ?? '' !!}<br>



<!-- Estado Id Field -->
{!! Form::label('estado_id', 'Estado:') !!}
{!! $activo->estado->nombre ?? '' !!}<br>


