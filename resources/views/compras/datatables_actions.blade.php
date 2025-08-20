
        <button  type="button"
            data-toggle="tooltip" title="Ver detalles"
            class="btn btn-icon btn-outline-info rounded-circle"
            data-bs-toggle="modal"
            data-bs-target="#modal-detalles-{{ $compra->id }}">
            <i class="fa fa-eye"></i>
        </button>


    @if($compra->puedeEditar())
        <a href="{{ route('compras.edit', $compra->id) }}" class='btn btn-icon btn-outline-primary rounded-circle' data-toggle="tooltip" title="Editar">
            <i class="fa fa-edit"></i>
        </a>
    @endif


    @if($compra->tiene1h())
     <a href="{{route('compra.h1.pdf',$compra->id)}}" target="_blank" class='btn btn-icon btn-outline-primary rounded-circle' data-toggle="tooltip" title="Imprimir 1H">
         <i class="fas fa-print"></i>
     </a>
    @endif

    @can('Anular Ingreso de almacen')
        @if($compra->puedeAnular())


            <button  type="button"
                data-toggle="tooltip" title="Anular Ingreso"
                class="btn btn-icon btn-outline-danger rounded-circle"
                data-bs-toggle="modal"
                onclick="deleteItemDt(this)"
                data-id="{{$compra->id}}"
            >
                <i class="fa fa-undo-alt"></i>
            </button>

            <form action="{{ route('compras.anular', $compra->id)}}" method="POST" id="delete-form{{$compra->id}}">
                @method('POST')
                @csrf
            </form>
        @endif
        @if($compra->puedeCancelar() )


            <button  type="button"
                data-toggle="tooltip" title="Cancelar Solicitud de Compra"
                class="btn btn-icon btn-outline-warning rounded-circle"
                data-bs-toggle="modal"
                data-bs-target="#modal-delete-{{ $compra->id }}">
                <i class="fas fa-ban" ></i>
            </button>
        @endif
    @endcan



