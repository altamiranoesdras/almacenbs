<!-- Solicitud Id Field -->
<div class="col-sm-12">
    {!! Form::label('solicitud_id', 'Solicitud Id:') !!}
    <p>{{ $compraSolicitudDetalle->solicitud_id }}</p>
</div>

<!-- Item Id Field -->
<div class="col-sm-12">
    {!! Form::label('item_id', 'Item Id:') !!}
    <p>{{ $compraSolicitudDetalle->item_id }}</p>
</div>

<!-- Cantidad Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    <p>{{ $compraSolicitudDetalle->cantidad }}</p>
</div>

<!-- Precio Estimado Field -->
<div class="col-sm-12">
    {!! Form::label('precio_estimado', 'Precio Estimado:') !!}
    <p>{{ $compraSolicitudDetalle->precio_estimado }}</p>
</div>

