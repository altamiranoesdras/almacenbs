<!-- Padre Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('padre_id', 'Padre Id:') !!}
    {!! Form::number('padre_id', null, ['class' => 'form-control']) !!}
</div>


<!-- Nombre Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>


<!-- Codigo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>
