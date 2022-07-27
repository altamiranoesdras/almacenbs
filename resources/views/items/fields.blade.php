<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','maxlength' => 25,'maxlength' => 25,'maxlength' => 25]) !!}
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100,'maxlength' => 100]) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Renglon Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('renglon_id', 'Renglon Id:') !!}
    {!! Form::number('renglon_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Marca Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('marca_id', 'Marca Id:') !!}
    {!! Form::number('marca_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Unimed Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unimed_id', 'Unimed Id:') !!}
    {!! Form::number('unimed_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Categoria Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('categoria_id', 'Categoria Id:') !!}
    {!! Form::number('categoria_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Precio Venta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio_venta', 'Precio Venta:') !!}
    {!! Form::number('precio_venta', null, ['class' => 'form-control']) !!}
</div>

<!-- Precio Compra Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio_compra', 'Precio Compra:') !!}
    {!! Form::number('precio_compra', null, ['class' => 'form-control']) !!}
</div>

<!-- Precio Promedio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio_promedio', 'Precio Promedio:') !!}
    {!! Form::number('precio_promedio', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Minimo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock_minimo', 'Stock Minimo:') !!}
    {!! Form::number('stock_minimo', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Maximo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock_maximo', 'Stock Maximo:') !!}
    {!! Form::number('stock_maximo', null, ['class' => 'form-control']) !!}
</div>

<!-- Ubicacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ubicacion', 'Ubicacion:') !!}
    {!! Form::text('ubicacion', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Perecedero Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('perecedero', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('perecedero', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('perecedero', 'Perecedero', ['class' => 'form-check-label']) !!}
    </div>
</div>
