<!-- Requisicion Id Field -->
<div class="col-sm-12">
    {!! Form::label('requisicion_id', 'Requisicion Id:') !!}
    <p>{{ $compraRequisicionDetalle->requisicion_id }}</p>
</div>

<!-- Solicitud Detalle Id Field -->
<div class="col-sm-12">
    {!! Form::label('solicitud_detalle_id', 'Solicitud Detalle Id:') !!}
    <p>{{ $compraRequisicionDetalle->solicitud_detalle_id }}</p>
</div>

<!-- Item Id Field -->
<div class="col-sm-12">
    {!! Form::label('item_id', 'Item Id:') !!}
    <p>{{ $compraRequisicionDetalle->item_id }}</p>
</div>

<!-- Cantidad Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    <p>{{ $compraRequisicionDetalle->cantidad }}</p>
</div>

<!-- Precio Estimado Field -->
<div class="col-sm-12">
    {!! Form::label('precio_estimado', 'Precio Estimado:') !!}
    <p>{{ $compraRequisicionDetalle->precio_estimado }}</p>
</div>

<!-- Observaciones Field -->
<div class="col-sm-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    <p>{{ $compraRequisicionDetalle->observaciones }}</p>
</div>

