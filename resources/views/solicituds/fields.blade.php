<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Correlativo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('correlativo', 'Correlativo:') !!}
    {!! Form::number('correlativo', null, ['class' => 'form-control']) !!}
</div>

<!-- Justificacion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('justificacion', 'Justificacion:') !!}
    {!! Form::textarea('justificacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Unidad Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unidad_id', 'Unidad Id:') !!}
    {!! Form::number('unidad_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuario Crea Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_crea', 'Usuario Crea:') !!}
    {!! Form::number('usuario_crea', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuario Solicita Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_solicita', 'Usuario Solicita:') !!}
    {!! Form::number('usuario_solicita', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuario Autoriza Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_autoriza', 'Usuario Autoriza:') !!}
    {!! Form::number('usuario_autoriza', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuario Aprueba Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_aprueba', 'Usuario Aprueba:') !!}
    {!! Form::number('usuario_aprueba', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuario Despacha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_despacha', 'Usuario Despacha:') !!}
    {!! Form::number('usuario_despacha', null, ['class' => 'form-control']) !!}
</div>

<!-- Firma Requiere Field -->
<div class="form-group col-sm-6">
    {!! Form::label('firma_requiere', 'Firma Requiere:') !!}
    {!! Form::text('firma_requiere', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Firma Autoriza Field -->
<div class="form-group col-sm-6">
    {!! Form::label('firma_autoriza', 'Firma Autoriza:') !!}
    {!! Form::text('firma_autoriza', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Firma Aprueba Field -->
<div class="form-group col-sm-6">
    {!! Form::label('firma_aprueba', 'Firma Aprueba:') !!}
    {!! Form::text('firma_aprueba', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Firma Almacen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('firma_almacen', 'Firma Almacen:') !!}
    {!! Form::text('firma_almacen', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Fecha Solicita Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_solicita', 'Fecha Solicita:') !!}
    {!! Form::text('fecha_solicita', null, ['class' => 'form-control','id'=>'fecha_solicita']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_solicita').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Fecha Autoriza Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_autoriza', 'Fecha Autoriza:') !!}
    {!! Form::text('fecha_autoriza', null, ['class' => 'form-control','id'=>'fecha_autoriza']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_autoriza').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Fecha Aprueba Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_aprueba', 'Fecha Aprueba:') !!}
    {!! Form::text('fecha_aprueba', null, ['class' => 'form-control','id'=>'fecha_aprueba']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_aprueba').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Fecha Almacen Firma Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_almacen_firma', 'Fecha Almacen Firma:') !!}
    {!! Form::text('fecha_almacen_firma', null, ['class' => 'form-control','id'=>'fecha_almacen_firma']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_almacen_firma').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Fecha Informa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_informa', 'Fecha Informa:') !!}
    {!! Form::text('fecha_informa', null, ['class' => 'form-control','id'=>'fecha_informa']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_informa').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Fecha Despacha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_despacha', 'Fecha Despacha:') !!}
    {!! Form::text('fecha_despacha', null, ['class' => 'form-control','id'=>'fecha_despacha']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_despacha').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    {!! Form::number('estado_id', null, ['class' => 'form-control']) !!}
</div>