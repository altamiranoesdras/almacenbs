
<span data-toggle="tooltip" title="Ver" >
    <button class='btn btn-icon btn-outline-secondary rounded-circle' data-bs-toggle="modal" data-target="#modalShowitemTraslados{{$id}}">
        <i class="fa fa-eye"></i>
    </button>
</span>

{{--<a href="{{ route('itemTraslados.edit', $id) }}" class='btn btn-icon btn-outline-info rounded-circle' data-toggle="tooltip" title="Editar">--}}
{{--    <i class="fa fa-edit"></i>--}}
{{--</a>--}}

@can('anular traslado entre productos')
    @if($itemTraslado->puedeAnular() )
        <a href="#" onclick="deleteItemDt(this)" data-id="{{$itemTraslado->id}}" data-toggle="tooltip" title="Anular Ingreso" class='btn btn-outline-danger btn-xs'>
            <i class="fa fa-undo-alt"></i>
        </a>


        <form action="{{ route('itemTraslados.anular', $itemTraslado->id)}}" method="POST" id="delete-form{{$itemTraslado->id}}">
            @method('POST')
            @csrf
        </form>
    @endif
@endcan



<!-- Modal Show -->
<div class="modal fade" id="modalShowitemTraslados{{$id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelTitleId">
                    Item Traslado
                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('item_traslados.show_fields',['itemTraslado' => $itemTraslado])
            </div>
        </div>
    </div>
</div>
