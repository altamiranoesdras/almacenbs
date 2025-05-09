<!-- Bodega Id Field -->
<div class="col-sm-12">
    {!! Form::label('bodega_id', 'Bodega Id:') !!}
    <p>{{ $compraSolicitud->bodega_id }}</p>
</div>

<!-- Proveedor Id Field -->
<div class="col-sm-12">
    {!! Form::label('proveedor_id', 'Proveedor Id:') !!}
    <p>{{ $compraSolicitud->proveedor_id }}</p>
</div>

<!-- Correlativo Field -->
<div class="col-sm-12">
    {!! Form::label('correlativo', 'Correlativo:') !!}
    <p>{{ $compraSolicitud->correlativo }}</p>
</div>

<!-- Codigo Field -->
<div class="col-sm-12">
    {!! Form::label('codigo', 'Codigo:') !!}
    <p>{{ $compraSolicitud->codigo }}</p>
</div>

<!-- Fecha Requiere Field -->
<div class="col-sm-12">
    {!! Form::label('fecha_requiere', 'Fecha Requiere:') !!}
    <p>{{ $compraSolicitud->fecha_requiere }}</p>
</div>

<!-- Observaciones Field -->
<div class="col-sm-12">
    {!! Form::label('justificacion', 'Observaciones:') !!}
    <p>{{ $compraSolicitud->justificacion }}</p>
</div>

<!-- Estado Id Field -->
<div class="col-sm-12">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    <p>{{ $compraSolicitud->estado_id }}</p>
</div>

<!-- Usuario Solicita Field -->
<div class="col-sm-12">
    {!! Form::label('usuario_solicita', 'Usuario Solicita:') !!}
    <p>{{ $compraSolicitud->usuario_solicita }}</p>
</div>

<!-- Usuario Aprueba Field -->
<div class="col-sm-12">
    {!! Form::label('usuario_aprueba', 'Usuario Aprueba:') !!}
    <p>{{ $compraSolicitud->usuario_aprueba }}</p>
</div>

<!-- Usuario Administra Field -->
<div class="col-sm-12">
    {!! Form::label('usuario_administra', 'Usuario Administra:') !!}
    <p>{{ $compraSolicitud->usuario_administra }}</p>
</div>

