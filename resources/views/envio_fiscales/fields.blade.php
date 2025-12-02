<!-- Nombre Tabla Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre_tabla', 'Nombre Tabla:') !!}
    {!! Form::select('nombre_tabla', [
        'compras' => 'Formulario 1H',
        'solicitudes' => 'Requisiciones Almacén',
        ], null, ['class' => 'form-select', 'required']) !!}
</div>


<!-- Numero Resolucion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero_resolucion', 'Numero Resolucion:') !!}
    {!! Form::text('numero_resolucion', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Numero Gestion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero_gestion', 'Numero Gestion:') !!}
    {!! Form::text('numero_gestion', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Fecha Gestion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha_gestion', 'Fecha Gestion:') !!}
    {!! Form::date('fecha_gestion', null, ['class' => 'form-control','id'=>'fecha_gestion']) !!}
</div>


<!-- Correlativo Resolucion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correlativo_resolucion', 'Correlativo Resolucion:') !!}
    {!! Form::text('correlativo_resolucion', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Fecha Correlativo Resolucion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha_correlativo_resolucion', 'Fecha Correlativo Resolucion:') !!}
    {!! Form::date('fecha_correlativo_resolucion', null, ['class' => 'form-control','id'=>'fecha_correlativo_resolucion']) !!}
</div>


<!-- Serie Envio Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('serie_envio', 'Serie Envio:') !!}
    {!! Form::text('serie_envio', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Numero Envio Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero_envio', 'Numero Envio:') !!}
    {!! Form::text('numero_envio', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Fecha Envio Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha_envio', 'Fecha Envio:') !!}
    {!! Form::date('fecha_envio', null, ['class' => 'form-control','id'=>'fecha_envio']) !!}
</div>


<!-- Correlativo Del Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correlativo_del', 'Correlativo Del:') !!}
    {!! Form::number('correlativo_del', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Correlativo Al Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correlativo_al', 'Correlativo Al:') !!}
    {!! Form::number('correlativo_al', null, ['class' => 'form-control', 'required']) !!}
</div>


{{--<!-- Correlativo Inicial Field -->--}}
{{--<div class="col-sm-6 mb-1">--}}
{{--    {!! Form::label('correlativo_inicial', 'Correlativo Inicial:') !!}--}}
{{--    {!! Form::number('correlativo_inicial', null, ['class' => 'form-control', 'required']) !!}--}}
{{--</div>--}}


{{--<!-- Correlativo Actual Field -->--}}
{{--<div class="col-sm-6 mb-1">--}}
{{--    {!! Form::label('correlativo_actual', 'Correlativo Actual:') !!}--}}
{{--    {!! Form::number('correlativo_actual', null, ['class' => 'form-control', 'required']) !!}--}}
{{--</div>--}}


<!-- Libro Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('libro', 'Libro:') !!}
    {!! Form::text('libro', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Folio Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('folio', 'Folio:') !!}
    {!! Form::number('folio', null, ['class' => 'form-control']) !!}
</div>


<!-- Activo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('activo', 'Activo:') !!}
    {!! Form::select('activo', ['si' => 'Sí', 'no' => 'No'], null, ['class' => 'form-select']) !!}
</div>
