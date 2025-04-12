<!-- Nuemero Constancia Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nuemero_constancia', 'Nuemero Constancia:') !!}
    {!! Form::number('nuemero_constancia', null, ['class' => 'form-control']) !!}
</div>

<!-- Serie Constancia Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('serie_constancia', 'Serie Constancia:') !!}
    {!! Form::text('serie_constancia', null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10,'maxlength' => 10]) !!}
</div>

<!-- Fecha Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::text('fecha', null, ['class' => 'form-control','id'=>'fecha']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Numero Cuenta Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero_cuenta', 'Numero Cuenta:') !!}
    {!! Form::text('numero_cuenta', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Forma Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('forma', 'Forma:') !!}
    {!! Form::text('forma', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Correlativo Del Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correlativo_del', 'Correlativo Del:') !!}
    {!! Form::number('correlativo_del', null, ['class' => 'form-control']) !!}
</div>

<!-- Correlativo Al Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correlativo_al', 'Correlativo Al:') !!}
    {!! Form::number('correlativo_al', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Pendientes Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('pendientes', 'Pendientes:') !!}
    {!! Form::number('pendientes', null, ['class' => 'form-control']) !!}
</div>

<!-- Serie Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('serie', 'Serie:') !!}
    {!! Form::text('serie', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Numero Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Libro Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('libro', 'Libro:') !!}
    {!! Form::text('libro', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Folio Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('folio', 'Folio:') !!}
    {!! Form::number('folio', null, ['class' => 'form-control']) !!}
</div>

<!-- Resolucion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('resolucion', 'Resolucion:') !!}
    {!! Form::text('resolucion', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Numero Gestion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero_gestion', 'Numero Gestion:') !!}
    {!! Form::text('numero_gestion', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Fecha Gestion Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha_gestion', 'Fecha Gestion:') !!}
    {!! Form::text('fecha_gestion', null, ['class' => 'form-control','id'=>'fecha_gestion']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_gestion').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Correlativo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correlativo', 'Correlativo:') !!}
    {!! Form::text('correlativo', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Activo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('activo', 'Activo:') !!}
    {!! Form::text('activo', null, ['class' => 'form-control']) !!}
</div>
