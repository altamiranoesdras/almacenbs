<!-- Magnitude Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('magnitude_id', 'Magnitude Id:') !!}
    {!! Form::number('magnitude_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Simbolo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('simbolo', 'Simbolo:') !!}
    {!! Form::text('simbolo', null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10,'maxlength' => 10]) !!}
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>