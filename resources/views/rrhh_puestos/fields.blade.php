<!-- Nombre Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Atribuciones Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('atribuciones', 'Atribuciones:') !!}
    {!! Form::textarea('atribuciones', null, ['class' => 'form-control']) !!}
</div>

<!-- Activo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('activo', 'Activo:') !!}
    {!! Form::text('activo', null, ['class' => 'form-control']) !!}
</div>
