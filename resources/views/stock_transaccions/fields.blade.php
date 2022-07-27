<!-- Model Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model_type', 'Model Type:') !!}
    {!! Form::text('model_type', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Model Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model_id', 'Model Id:') !!}
    {!! Form::number('model_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock_id', 'Stock Id:') !!}
    {!! Form::number('stock_id', null, ['class' => 'form-control']) !!}
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

<!-- Precio Costo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio_costo', 'Precio Costo:') !!}
    {!! Form::number('precio_costo', null, ['class' => 'form-control']) !!}
</div>