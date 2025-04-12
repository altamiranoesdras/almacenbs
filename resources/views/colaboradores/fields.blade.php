<!-- Nombres Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombres', 'Nombres:') !!}
    {!! Form::text('nombres', null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>

<!-- Apellidos Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('apellidos', 'Apellidos:') !!}
    {!! Form::text('apellidos', null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>

<!-- Dpi Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('dpi', 'Dpi:') !!}
    {!! Form::text('dpi', null, ['class' => 'form-control','maxlength' => 13]) !!}
</div>

<!-- Correo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correo', 'Correo:') !!}
    {!! Form::text('correo', null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>

<!-- Telefono Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('telefono', 'Teléfono:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control','maxlength' => 45]) !!}
</div>

<!-- Direccion Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('direccion', 'Dirección:') !!}
    {!! Form::textarea('direccion', null, ['class' => 'form-control','rows' => 2]) !!}
</div>

<!-- Nit Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nit', 'Nit:') !!}
    {!! Form::text('nit', null, ['class' => 'form-control','maxlength' => 10]) !!}
</div>

<!-- Puesto Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('puesto_id', 'Puesto Id:') !!}
    {!! Form::number('puesto_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Unidad Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('unidad_id', 'Unidad Id:') !!}
    {!! Form::number('unidad_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>
