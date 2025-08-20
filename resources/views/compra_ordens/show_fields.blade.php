<!-- Gestion Id Field -->
<div class="col-sm-12">
    {!! Form::label('gestion_id', 'Gestion Id:') !!}
    <p>{{ $compraOrden->gestion_id }}</p>
</div>

<!-- Proveedor Id Field -->
<div class="col-sm-12">
    {!! Form::label('proveedor_id', 'Proveedor Id:') !!}
    <p>{{ $compraOrden->proveedor_id }}</p>
</div>

<!-- Numero Field -->
<div class="col-sm-12">
    {!! Form::label('numero', 'Numero:') !!}
    <p>{{ $compraOrden->numero }}</p>
</div>

<!-- Fecha Field -->
<div class="col-sm-12">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{{ $compraOrden->fecha }}</p>
</div>

<!-- Estado Field -->
<div class="col-sm-12">
    {!! Form::label('estado', 'Estado:') !!}
    <p>{{ $compraOrden->estado }}</p>
</div>

<!-- Observaciones Field -->
<div class="col-sm-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    <p>{{ $compraOrden->observaciones }}</p>
</div>

