<!-- Tipo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_id', 'Tipo Id:') !!}
    {!! Form::number('tipo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Proveedor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('proveedor_id', 'Proveedor Id:') !!}
    {!! Form::number('proveedor_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Correlativo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('correlativo', 'Correlativo:') !!}
    {!! Form::number('correlativo', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Documento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_documento', 'Fecha Documento:') !!}
    {!! Form::text('fecha_documento', null, ['class' => 'form-control','id'=>'fecha_documento']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_documento').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Fecha Ingreso Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_ingreso', 'Fecha Ingreso:') !!}
    {!! Form::text('fecha_ingreso', null, ['class' => 'form-control','id'=>'fecha_ingreso']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_ingreso').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Serie Field -->
<div class="form-group col-sm-6">
    {!! Form::label('serie', 'Serie:') !!}
    {!! Form::text('serie', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Numero Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control','maxlength' => 20,'maxlength' => 20,'maxlength' => 20]) !!}
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    {!! Form::number('estado_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuario Crea Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_crea', 'Usuario Crea:') !!}
    {!! Form::number('usuario_crea', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuario Recibe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_recibe', 'Usuario Recibe:') !!}
    {!! Form::number('usuario_recibe', null, ['class' => 'form-control']) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
</div>