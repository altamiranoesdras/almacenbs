<!-- Compra Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('compra_id', 'Compra Id:') !!}
    {!! Form::number('compra_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('item_id', 'Item Id:') !!}
    {!! Form::number('item_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Precio Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::number('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Descuento Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('descuento', 'Descuento:') !!}
    {!! Form::number('descuento', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Ven Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha_vence', 'Fecha Ven:') !!}
    {!! Form::text('fecha_vence', null, ['class' => 'form-control','id'=>'fecha_vence']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#fecha_vence').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush
