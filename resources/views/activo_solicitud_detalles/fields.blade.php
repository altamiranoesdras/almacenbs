<!-- Solicitud Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('solicitud_id', 'Solicitud Id:') !!}
    {!! Form::number('solicitud_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Activo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activo_id', 'Activo Id:') !!}
    {!! Form::number('activo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    {!! Form::number('estado_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Solicitud Tipo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('solicitud_tipo_id', 'Solicitud Tipo Id:') !!}
    {!! Form::number('solicitud_tipo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
</div>