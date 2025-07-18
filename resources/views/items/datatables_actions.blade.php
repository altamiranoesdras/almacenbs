
@can('Crear Artículos')
<a href="{{ route('items.show', $item->id) }}" class='btn btn-icon btn-flat-secondary rounded-circle' data-toggle="tooltip" title="Ver">
    <i class="fa fa-eye"></i>
</a>
@endcan

{{--<a href="{{ route('items.clonar', $item->id) }}" class='btn btn-icon btn-flat-secondary rounded-circle' data-toggle="tooltip" title="Copiar articulo">--}}
{{--    <i class="fa fa-clone"></i>--}}
{{--</a>--}}

@can('Editar Artículos')
    <a href="{{ route('items.edit', $item->id) }}" class='btn btn-icon btn-flat-info rounded-circle' data-toggle="tooltip" title="Editar">
    <i class="fa fa-edit"></i>
</a>
@endcan


@can('Eliminar Artículos')
<span data-toggle="tooltip" title="Eliminar">
    <a href="#modal-delete-{{$item->id}}" data-bs-toggle="modal" data-keyboard="true" class='btn btn-icon btn-flat-danger rounded-circle'>
        <i class="fa fa-trash-alt"></i>
    </a>
</span>

<div class="modal fade modal-warning" id="modal-delete-{{$item->id}}" tabindex='-1'>
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => ['items.destroy', $item->id], 'method' => 'delete']) !!}
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title">Eliminar!</h4>
            </div>
            <div class="modal-body">

                    Seguro desea eliminar el registro?

                    {{--<p class="text-bold">Este artículo no se puede eliminar porque esta en una venta o en una compra</p>--}}

            </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">SI</button>
                </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endcan
