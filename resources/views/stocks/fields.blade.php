<!-- Item Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_id', 'Item Id:') !!}
    {!! Form::number('item_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Lote Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lote', 'Lote:') !!}
    {!! Form::text('lote', null, ['class' => 'form-control','maxlength' => 25,'maxlength' => 25,'maxlength' => 25]) !!}
</div>

<!-- Fecha Ing Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_ing', 'Fecha Ing:') !!}
    {!! Form::text('fecha_ing', null, ['class' => 'form-control','id'=>'fecha_ing']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_ing').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Fecha Vence Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_vence', 'Fecha Vence:') !!}
    {!! Form::text('fecha_vence', null, ['class' => 'form-control','id'=>'fecha_vence']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_vence').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Precio Compra Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio_compra', 'Precio Compra:') !!}
    {!! Form::number('precio_compra', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Inicial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad_inicial', 'Cantidad Inicial:') !!}
    {!! Form::number('cantidad_inicial', null, ['class' => 'form-control']) !!}
</div>

<!-- Orden Salida Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('orden_salida', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('orden_salida', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('orden_salida', 'Orden Salida', ['class' => 'form-check-label']) !!}
    </div>
</div>
