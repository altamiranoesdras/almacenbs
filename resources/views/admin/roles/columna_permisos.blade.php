@if($role->permissions->count() > 0)
    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalPermisos{{$id}}">
        Ver Permisos
    </button>
@else
    <span class="badge bg-warning text-dark">Sin permisos</span>
@endif

<!-- Modal para ver permisos -->
<div class="modal fade" id="modalPermisos{{$id}}" tabindex="-1" aria-labelledby="modalPermisosLabel{{$id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content shadow-sm">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPermisosLabel{{$id}}">
                    <i class="fas fa-user-shield me-2 text-secondary"></i> Permisos del Rol
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body p-2" style="max-height: 60vh; overflow-y: auto;">
                <div class="mb-2">
                    <input type="text" class="form-control form-control-sm" placeholder="Buscar permiso..."
                           onkeyup="filtrarPermisos{{$id}}(this.value)">
                </div>

                <ul class="list-group list-group-flush small" id="listaPermisos{{$id}}">
                    @forelse($role->permissions as $permiso)
                        <li class="list-group-item py-1 px-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            {{ $permiso->name }}
                        </li>
                    @empty
                        <li class="list-group-item text-center">
                            <span class="badge bg-warning text-dark">Sin permisos</span>
                        </li>
                    @endforelse
                </ul>
            </div>

            <div class="modal-footer py-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function filtrarPermisos{{$id}}(texto) {
        const filtro = texto.toLowerCase();
        const items = document.querySelectorAll('#listaPermisos{{$id}} li');
        items.forEach(li => {
            li.style.display = li.textContent.toLowerCase().includes(filtro) ? '' : 'none';
        });
    }
</script>
