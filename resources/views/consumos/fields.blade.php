<!-- Correlativo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correlativo', 'Correlativo:') !!}
    {!! Form::number('correlativo', null, ['class' => 'form-control']) !!}
</div>

<!-- Codigo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Estado Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    {!! Form::number('estado_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Unidad Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('unidad_id', 'Unidad Id:') !!}
    {!! Form::number('unidad_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Bodega Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('bodega_id', 'Bodega Id:') !!}
    {!! Form::number('bodega_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuario Crea Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('usuario_crea', 'Usuario Crea:') !!}
    {!! Form::number('usuario_crea', null, ['class' => 'form-control']) !!}
</div>
