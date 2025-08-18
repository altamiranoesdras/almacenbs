<!-- Requisicion Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('requisicion_id', 'Requisicion Id:') !!}
    {!! Form::number('requisicion_id', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Solicitud Detalle Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('solicitud_detalle_id', 'Solicitud Detalle Id:') !!}
    {!! Form::number('solicitud_detalle_id', null, ['class' => 'form-control', 'required']) !!}
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


<!-- Precio Estimado Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('precio_estimado', 'Precio Estimado:') !!}
    {!! Form::number('precio_estimado', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Observaciones Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::text('observaciones', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>
