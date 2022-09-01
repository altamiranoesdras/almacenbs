<!-- Responsable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('responsable_id', 'Responsable Id:') !!}
    {!! Form::number('responsable_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Correlativo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('correlativo', 'Correlativo:') !!}
    {!! Form::number('correlativo', null, ['class' => 'form-control']) !!}
</div>