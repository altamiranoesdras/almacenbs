<!-- Red Produccion Resultado Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('red_produccion_resultado_id', 'Red Produccion Resultado Id:') !!}
    {!! Form::number('red_produccion_resultado_id', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Codigo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control', 'required', 'maxlength' => 4, 'maxlength' => 4]) !!}
</div>


<!-- Nombre Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 500, 'maxlength' => 500]) !!}
</div>
