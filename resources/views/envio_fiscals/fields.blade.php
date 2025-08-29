<!-- Nombre Tabla Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre_tabla', 'Nombre Tabla:') !!}
    {!! Form::text('nombre_tabla', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
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
    {!! Form::label('nuemero_constancia', 'Nuemero Constancia:') !!}
    {!! Form::number('nuemero_constancia', null, ['class' => 'form-control']) !!}
</div>


<!-- Serie Constancia Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('serie_constancia', 'Serie Constancia:') !!}
    {!! Form::text('serie_constancia', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Fecha Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::text('fecha', null, ['class' => 'form-control','id'=>'fecha']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#fecha').datepicker()
    </script>
@endpush


<!-- Numero Cuenta Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero_cuenta', 'Numero Cuenta:') !!}
    {!! Form::text('numero_cuenta', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Forma Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('forma', 'Forma:') !!}
    {!! Form::text('forma', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Serie Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('serie', 'Serie:') !!}
    {!! Form::text('serie', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Numero Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Libro Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('libro', 'Libro:') !!}
    {!! Form::text('libro', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Folio Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('folio', 'Folio:') !!}
    {!! Form::number('folio', null, ['class' => 'form-control']) !!}
</div>


<!-- Resolucion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('resolucion', 'Resolucion:') !!}
    {!! Form::text('resolucion', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Numero Gestion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero_gestion', 'Numero Gestion:') !!}
    {!! Form::text('numero_gestion', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Fecha Gestion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha_gestion', 'Fecha Gestion:') !!}
    {!! Form::text('fecha_gestion', null, ['class' => 'form-control','id'=>'fecha_gestion']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#fecha_gestion').datepicker()
    </script>
@endpush


<!-- Correlativo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correlativo', 'Correlativo:') !!}
    {!! Form::text('correlativo', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Activo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('activo', 'Activo:') !!}
    {!! Form::text('activo', null, ['class' => 'form-control']) !!}
</div>
