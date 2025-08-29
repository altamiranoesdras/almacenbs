<!-- Tipo Concurso Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('tipo_concurso_id', 'Tipo Concurso Id:') !!}
    {!! Form::number('tipo_concurso_id', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Ipo Adquisicion Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('tipo_adquisicion_id', 'Ipo Adquisicion Id:') !!}
    {!! Form::number('tipo_adquisicion_id', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Correlativo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correlativo', 'Correlativo:') !!}
    {!! Form::number('correlativo', null, ['class' => 'form-control']) !!}
</div>


<!-- Codigo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control', 'required', 'maxlength' => 20, 'maxlength' => 20]) !!}
</div>


<!-- Codigo Consolidacion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('codigo_consolidacion', 'Codigo Consolidacion:') !!}
    {!! Form::text('codigo_consolidacion', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>


<!-- Npg Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('npg', 'Npg:') !!}
    {!! Form::text('npg', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>


<!-- Nog Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nog', 'Nog:') !!}
    {!! Form::text('nog', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>


<!-- Proveedor Adjudicado Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('proveedor_adjudicado', 'Proveedor Adjudicado:') !!}
    {!! Form::number('proveedor_adjudicado', null, ['class' => 'form-control']) !!}
</div>


<!-- Numero Adjudicacion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero_adjudicacion', 'Numero Adjudicacion:') !!}
    {!! Form::text('numero_adjudicacion', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>


<!-- Estado Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    {!! Form::number('estado_id', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Subproductos Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('subproductos', 'Subproductos:') !!}
    {!! Form::text('subproductos', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>


<!-- Partidas Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('partidas', 'Partidas:') !!}
    {!! Form::text('partidas', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>


<!-- Observaciones Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>


<!-- Justificacion Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('justificacion', 'Justificacion:') !!}
    {!! Form::textarea('justificacion', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>
