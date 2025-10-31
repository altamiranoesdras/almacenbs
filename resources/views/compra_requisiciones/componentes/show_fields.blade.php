<div class="row g-3 mb-2">
    <div class="col-md-4">
        <div class="mb-1">
            <label class="form-label mb-0">Estado:</label>
            <div>
                <span class="badge bg-primary fw-bold">
                    {{ $requisicion->estado->nombre ?? 'Pendiente' }}
                </span>
            </div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">Código:</label>
            <div><span class="fw-bold">{{ $requisicion->codigo }}</span></div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">Tipo Concurso:</label>
            <div><span class="fw-bold">{{ $requisicion->tipoConcurso->nombre ?? 'Pendiente' }}</span></div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">Tipo Adquisición:</label>
            <div><span class="fw-bold">{{ $requisicion->tipoAdquisicion->nombre ?? 'Pendiente' }}</span></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-1">
            <label class="form-label mb-0">Proveedor Adjudicado:</label>
            <div><span class="fw-bold">{{ $requisicion->proveedorAdjudicado->nombre ?? 'Pendiente' }}</span></div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">Número Adjudicación:</label>
            <div><span class="fw-bold">{{ $requisicion->numero_adjudicacion }}</span></div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">Código Consolidación:</label>
            <div><span class="fw-bold">{{ $requisicion->codigo_consolidacion }}</span></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-1">
            <label class="form-label mb-0">NPG:</label>
            <div><span class="fw-bold">{{ $requisicion->npg }}</span></div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">NOG:</label>
            <div><span class="fw-bold">{{ $requisicion->nog }}</span></div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">Justificación:</label>
            <div><span class="fw-bold">{{ $requisicion->justificacion }}</span></div>
        </div>

    </div>
</div>
