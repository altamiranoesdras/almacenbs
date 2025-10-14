<!-- Datos del Rol -->
<div class="row g-2 mb-3">
    <div class="col-md-6">
        {!! Form::label('name', 'Nombre del Rol:', ['class' => 'form-label fw-semibold']) !!}
        <p class="mb-2">{{ $role->name }}</p>
    </div>

    <div class="col-md-6">
        {!! Form::label('guard_name', 'Guard Name:', ['class' => 'form-label fw-semibold']) !!}
        <p class="mb-2">{{ $role->guard_name }}</p>
    </div>
</div>

<!-- Permisos del Rol -->
<div class="mt-3">
    <div class="d-flex align-items-center justify-content-between">
        <label for="permSearch" class="form-label fw-semibold mb-1">
            Permisos del Rol
        </label>
        <span class="badge bg-light text-dark">
            Total: {{ $role->permissions->count() }}
        </span>
    </div>

    <!-- Buscador -->
    <input
        type="text"
        id="permSearch"
        class="form-control form-control-sm mb-2"
        placeholder="Buscar permiso..."
        @disabled($role->permissions->isEmpty())
    >

    <!-- Lista con scroll -->
    <ul
        class="list-group list-group-flush small"
        id="permList"
        style="max-height: 40vh; overflow-y: auto; border: 1px solid #e9ecef; border-radius: .5rem;"
    >
        @forelse ($role->permissions as $permiso)
            <li
                class="list-group-item py-1 px-2 d-flex align-items-center"
                data-name="{{ Str::lower($permiso->name) }}"
                title="{{ $permiso->name }}"
            >
                <i class="fas fa-check-circle text-success me-2"></i>
                <span class="text-truncate">{{ $permiso->name }}</span>
            </li>
        @empty
            <li class="list-group-item text-center py-2">
                <span class="badge bg-warning text-dark">Sin permisos asignados</span>
            </li>
        @endforelse

        <!-- Estado sin coincidencias -->
        <li class="list-group-item text-center py-2 d-none" id="permNoMatch">
            <em>No hay coincidencias…</em>
        </li>
    </ul>
</div>

<!-- Filtro en vivo (JS nativo, sin dependencias) -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input   = document.getElementById('permSearch');
        const list    = document.getElementById('permList');
        const items   = Array.from(list.querySelectorAll('li[data-name]'));
        const noMatch = document.getElementById('permNoMatch');

        if (!input || !items.length) return;

        input.addEventListener('input', e => {
            const q = e.target.value.toLowerCase().trim();
            let visible = 0;

            items.forEach(li => {
                const match = li.dataset.name.includes(q);
                li.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            noMatch.classList.toggle('d-none', !(q && visible === 0));
        });
    });
</script>
