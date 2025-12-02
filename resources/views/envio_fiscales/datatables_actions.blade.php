@can('Ver Envió Fiscal')
    <a href="{{ route('envioFiscales.show', $id) }}" data-bs-toggle="tooltip" title="Ver" class='btn btn-icon btn-outline-secondary rounded-circle'>
        <i class="fa fa-eye"></i>
    </a>
@endcan

@can('Editar Envió Fiscal')
    @if($envioFiscal->puedeEditar())
        <a href="{{ route('envioFiscales.edit', $id) }}" data-bs-toggle="tooltip" title="Editar" class='btn btn-icon btn-outline-info rounded-circle'>
            <i class="fa fa-edit"></i>
        </a>
    @endif
@endcan

@can('Desactivar envió Fiscal')
    @if($envioFiscal->puedeDesactivar())

        <!-- Button trigger modal -->
        <button type="button" class='btn btn-icon btn-outline-warning rounded-circle' data-bs-toggle="modal" data-bs-target="#modalDesactivar">
            <i class="fa fa-ban"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalDesactivar" tabindex="-1" role="dialog" aria-labelledby="modalDesactivarTitulo"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDesactivarTitulo">
                            Desactivar Envío Fiscal
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Está seguro de que desea desactivar este envío fiscal?</p>
                        <p>Esta acción no se puede deshacer.</p>

                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('envioFiscales.desactivar', $id) }}" method="POST" id="delete-form-modal" class="esperar">
                            @csrf

                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-outline-warning" onclick="esperar()">
                                <i class="fa fa-ban"></i>
                                Desactivar
                            </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>

    @endif
@endcan


{{--@can('Eliminar Envió Fiscal')--}}
{{--    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-bs-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-outline-danger rounded-circle'>--}}
{{--        <i class="fa fa-trash-alt"></i>--}}
{{--    </a>--}}
{{--    <form action="{{ route('envioFiscales.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">--}}
{{--        @method('DELETE')--}}
{{--        @csrf--}}
{{--    </form>--}}
{{--@endcan--}}

