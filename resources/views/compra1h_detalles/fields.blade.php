<!-- 1H Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('1h_id', '1H Id:') !!}
    {!! Form::number('1h_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('item_id', 'Item Id:') !!}
    {!! Form::number('item_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Precio Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::number('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Folio Almacen Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('folio_almacen', 'Folio Almacen:') !!}
    {!! Form::number('folio_almacen', null, ['class' => 'form-control']) !!}
</div>

<!-- Folio Inventario Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('folio_inventario', 'Folio Inventario:') !!}
    {!! Form::number('folio_inventario', null, ['class' => 'form-control']) !!}
</div>

<!-- Codigo Inventario Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('codigo_inventario', 'Codigo Inventario:') !!}
    {!! Form::text('codigo_inventario', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50,'maxlength' => 50]) !!}
</div>
