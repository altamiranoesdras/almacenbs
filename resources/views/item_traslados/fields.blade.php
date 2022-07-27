<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Correlativo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('correlativo', 'Correlativo:') !!}
    {!! Form::number('correlativo', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Origen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_origen', 'Item Origen:') !!}
    {!! Form::number('item_origen', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Origen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad_origen', 'Cantidad Origen:') !!}
    {!! Form::number('cantidad_origen', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Destino Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_destino', 'Item Destino:') !!}
    {!! Form::number('item_destino', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Destino Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad_destino', 'Cantidad Destino:') !!}
    {!! Form::number('cantidad_destino', null, ['class' => 'form-control']) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    {!! Form::number('estado_id', null, ['class' => 'form-control']) !!}
</div>