@push('css')
<style>
    .form-group{margin-bottom: 0px}
</style>
@endpush
<!--Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    {!! $item->id !!}
</div>

<!-- Nombre Field -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! $item->nombre !!}
</div>

<!-- Descripcion Field -->
<div class="form-group">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! $item->descripcion !!}
</div>

<!-- Codigo Field -->
<div class="form-group">
    {!! Form::label('codigo', 'Codigo insumo:') !!}
    {!! $item->codigo_insumo !!}
</div>

<!-- Codigo presentacion Field -->
<div class="form-group">
    {!! Form::label('codigo_presentacion', 'Codigo presentacion:') !!}
    {!! $item->codigo_presentacion !!}
</div>

<!-- Precio Venta Field -->
<div class="form-group">
    {!! Form::label('precio_venta', 'Precio Venta:') !!}
    {!! $item->precio_venta !!}
</div>

<!-- Precio Compra Field -->
<div class="form-group">
    {!! Form::label('precio_compra', 'Precio Compra:') !!}
    {!! $item->precio_compra !!}
</div>


<!-- Precio Promedio Field -->
<div class="form-group">
    {!! Form::label('precio_promedio', 'Precio Promedio:') !!}
    {!! $item->precio_promedio !!}
</div>

<!-- Stock Field -->
<div class="form-group">
    {!! Form::label('stock', 'Stock:') !!}
    {!! $item->stock_total !!} ({{ $item->stock_reservado }} reservados)
</div>

<!-- Ubicacion Field -->
<div class="form-group">
    {!! Form::label('ubicacion', 'Ubicacion:') !!}
    {!! $item->ubicacion !!}
</div>

{{--<!-- Inventariable Field -->--}}
{{--<div class="form-group">--}}
{{--    {!! Form::label('inventariable', 'Inventariable:') !!}--}}
{{--    {!! $item->inventariable !!}--}}
{{--</div>--}}

<!-- Marca Field -->
<div class="form-group">
    {!! Form::label('marca_id', 'Marca:') !!}
    {!! $item->marca->nombre ?? 'Sin marca' !!}
</div>

<!-- Unimed Field -->
<div class="form-group">
    {!! Form::label('unimed_id', 'Unidad de medida:') !!}
    {!! $item->unimed->nombre ?? 'Sin unidad de medida' !!}
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado el:') !!}
    {!! $item->created_at !!}
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Actualizado el:') !!}
    {!! $item->updated_at !!}
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Borrado el:') !!}
    {!! $item->deleted_at !!}
</div>

<!-- link a kardex -->
<div class="form-group mt-3">
    <a href="{{ route('reportes.kardex'). '?item_id=' . $item->id.'&buscar=1' }}" class="btn btn-outline-primary btn-sm" target="_blank">
        <i class="fa fa-list"></i> Ver Kardex
    </a>
</div>
