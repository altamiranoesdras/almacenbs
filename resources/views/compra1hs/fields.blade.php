<!-- Compra Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('compra_id', 'Compra Id:') !!}
    {!! Form::number('compra_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Envio Fiscal Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('envio_fiscal_id', 'Envio Fiscal Id:') !!}
    {!! Form::number('envio_fiscal_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Codigo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Correlativo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correlativo', 'Correlativo:') !!}
    {!! Form::number('correlativo', null, ['class' => 'form-control']) !!}
</div>

<!-- Del Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('del', 'Del:') !!}
    {!! Form::number('del', null, ['class' => 'form-control']) !!}
</div>

<!-- Al Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('al', 'Al:') !!}
    {!! Form::number('al', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Procesa Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha_procesa', 'Fecha Procesa:') !!}
    {!! Form::text('fecha_procesa', null, ['class' => 'form-control','id'=>'fecha_procesa']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_procesa').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Usuario Procesa Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('usuario_procesa', 'Usuario Procesa:') !!}
    {!! Form::number('usuario_procesa', null, ['class' => 'form-control']) !!}
</div>

<!-- Observaciones Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
</div>
