<!-- Nit Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nit', 'Nit:') !!}
    {!! Form::text('nit', null, ['class' => 'form-control','maxlength' => 10]) !!}
</div>

<!-- Nombre Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 45]) !!}
</div>

<!-- Razon Social Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('razon_social', 'Razon Social:') !!}
    {!! Form::text('razon_social', null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>

<!-- Correo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correo', 'Correo:') !!}
    {!! Form::text('correo', null, ['class' => 'form-control','maxlength' => 100]) !!}
</div>

<!-- Telefono Movil Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('telefono_movil', 'Telefono Movil:') !!}
    {!! Form::text('telefono_movil', null, ['class' => 'form-control','maxlength' => 8]) !!}
</div>

<!-- Telefono Oficina Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('telefono_oficina', 'Telefono Oficina:') !!}
    {!! Form::text('telefono_oficina', null, ['class' => 'form-control','maxlength' => 8]) !!}
</div>

<!-- Direccion Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::textarea('direccion', null, ['class' => 'form-control', 'rows' => 2]) !!}
</div>

<!-- Observaciones Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => 2]) !!}
</div>
