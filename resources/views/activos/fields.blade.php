<!-- Codigo Inventario Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo_inventario', 'Codigo Inventario:') !!}
    {!! Form::text('codigo_inventario', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100,'maxlength' => 100]) !!}
</div>

<!-- Folio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('folio', 'Folio:') !!}
    {!! Form::text('folio', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100,'maxlength' => 100]) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::number('valor', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Registra Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_registra', 'Fecha Registra:') !!}
    {!! Form::date('fecha_registra', null, ['class' => 'form-control','id'=>'fecha_registra']) !!}
</div>


<!-- Tipo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_id', 'Tipo Id:') !!}
    {!! Form::number('tipo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Detalle 1H Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('detalle_1h_id', 'Detalle 1H Id:') !!}
    {!! Form::number('detalle_1h_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    {!! Form::number('estado_id', null, ['class' => 'form-control']) !!}
</div>
