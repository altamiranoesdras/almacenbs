<!-- Rol Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('rol_id', 'Rol Id:') !!}
    {!! Form::number('rol_id', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Nombre Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Descripcion Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>
