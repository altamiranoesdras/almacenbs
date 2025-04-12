<!-- Nombre Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre', 'Nombre:') !!}
    <span class="text-danger">*</span>
    {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Direccion Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::textarea('direccion', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefono Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('telefono', 'Telefono:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control','maxlength' => 30,'maxlength' => 30,'maxlength' => 30]) !!}
</div>
