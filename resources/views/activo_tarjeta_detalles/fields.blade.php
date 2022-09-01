<!-- Tarjeta Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tarjeta_id', 'Tarjeta Id:') !!}
    {!! Form::number('tarjeta_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Activo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activo_id', 'Activo Id:') !!}
    {!! Form::number('activo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo', 'Tipo:') !!}
    {!! Form::text('tipo', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::number('valor', null, ['class' => 'form-control']) !!}
</div>

<!-- Unidad Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unidad_id', 'Unidad Id:') !!}
    {!! Form::number('unidad_id', null, ['class' => 'form-control']) !!}
</div>