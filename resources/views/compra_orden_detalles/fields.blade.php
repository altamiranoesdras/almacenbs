<!-- Orden Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('orden_id', 'Orden Id:') !!}
    {!! Form::number('orden_id', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Item Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('item_id', 'Item Id:') !!}
    {!! Form::number('item_id', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Cantidad Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Precio Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::number('precio', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Observacion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('observacion', 'Observacion:') !!}
    {!! Form::text('observacion', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>
