<!-- Codigo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Nombre Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Departamento Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('departamento_id', 'Departamento Id:') !!}
    {!! Form::number('departamento_id', null, ['class' => 'form-control']) !!}
</div>
