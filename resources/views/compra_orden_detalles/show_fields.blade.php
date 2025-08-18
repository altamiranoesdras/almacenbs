<!-- Orden Id Field -->
<div class="col-sm-12">
    {!! Form::label('orden_id', 'Orden Id:') !!}
    <p>{{ $compraOrdenDetalle->orden_id }}</p>
</div>

<!-- Item Id Field -->
<div class="col-sm-12">
    {!! Form::label('item_id', 'Item Id:') !!}
    <p>{{ $compraOrdenDetalle->item_id }}</p>
</div>

<!-- Cantidad Field -->
<div class="col-sm-12">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    <p>{{ $compraOrdenDetalle->cantidad }}</p>
</div>

<!-- Precio Field -->
<div class="col-sm-12">
    {!! Form::label('precio', 'Precio:') !!}
    <p>{{ $compraOrdenDetalle->precio }}</p>
</div>

<!-- Observacion Field -->
<div class="col-sm-12">
    {!! Form::label('observacion', 'Observacion:') !!}
    <p>{{ $compraOrdenDetalle->observacion }}</p>
</div>

