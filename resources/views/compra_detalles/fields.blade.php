<!-- Compra Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('compra_id', 'Compra Id:') !!}
    {!! Form::number('compra_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_id', 'Item Id:') !!}
    {!! Form::number('item_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::number('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Descuento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descuento', 'Descuento:') !!}
    {!! Form::number('descuento', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Ven Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_vence', 'Fecha Ven:') !!}
    {!! Form::text('fecha_vence', null, ['class' => 'form-control','id'=>'fecha_vence']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_ven').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush
