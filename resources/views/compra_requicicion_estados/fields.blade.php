<!-- Nombre Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Tipo Proceso Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('tipo_proceso', 'Tipo Proceso:') !!}
    {!! Form::text('tipo_proceso', null, ['class' => 'form-control']) !!}
</div>
