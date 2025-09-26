<!-- Nombre Tabla Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre_tabla', 'Nombre Tabla:') !!}
    {!! Form::select('nombre_tabla', [
        'compras' => 'Formulario 1H',
        'solicitudes' => 'Requisiciones Almacén',
        ], null, ['class' => 'form-select', 'required']) !!}
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

<!-- Folio Inicial Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('folio_inicial', 'Folio Inicial:') !!}
    {!! Form::number('folio_inicial', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Folio Actual Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('folio_actual', 'Folio Actual:') !!}
    {!! Form::number('folio_actual', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Nuemero Constancia Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero_constancia', 'Número Constancia:') !!}
    {!! Form::number('numero_constancia', null, ['class' => 'form-control']) !!}
</div>

<!-- Serie Constancia Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('serie_constancia', 'Serie Constancia:') !!}
    {!! Form::text('serie_constancia', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Fecha Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::date('fecha', null, ['class' => 'form-control']) !!}
</div>

<!-- Numero Cuenta Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero_cuenta', 'Número Cuenta:') !!}
    {!! Form::text('numero_cuenta', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Forma Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('forma', 'Forma:') !!}
    {!! Form::text('forma', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Serie Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('serie', 'Serie:') !!}
    {!! Form::text('serie', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Numero Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero', 'Número:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Libro Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('libro', 'Libro:') !!}
    {!! Form::text('libro', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Folio Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('folio', 'Folio:') !!}
    {!! Form::number('folio', null, ['class' => 'form-control']) !!}
</div>

<!-- Resolucion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('resolucion', 'Resolución:') !!}
    {!! Form::text('resolucion', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Numero Gestion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero_gestion', 'Número Gestión:') !!}
    {!! Form::text('numero_gestion', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Fecha Gestion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha_gestion', 'Fecha Gestión:') !!}
    {!! Form::date('fecha_gestion', null, ['class' => 'form-control']) !!}
</div>

<!-- Correlativo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correlativo', 'Correlativo:') !!}
    {!! Form::text('correlativo', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Activo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('activo', 'Activo:') !!}
    {!! Form::select('activo', ['si' => 'Sí', 'no' => 'No'], null, ['class' => 'form-select']) !!}
</div>
