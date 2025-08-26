<div class="row">
    <!-- Tipo Concurso -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>Tipo Concurso:</strong> {{ $compraRequisicion->tipoConcurso->nombre ?? 'Pendiente' }}</p>
    </div>

    <!-- Tipo Adquisicion -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>Tipo Adquisición:</strong> {{ $compraRequisicion->tipoAdquisicion->nombre ?? 'Pendiente' }}</p>
    </div>

    <!-- Correlativo -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>Correlativo:</strong> {{ $compraRequisicion->correlativo }}</p>
    </div>

    <!-- Código -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>Código:</strong> {{ $compraRequisicion->codigo }}</p>
    </div>

    <!-- Código Consolidación -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>Código Consolidación:</strong> {{ $compraRequisicion->codigo_consolidacion }}</p>
    </div>

    <!-- NPG -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>NPG:</strong> {{ $compraRequisicion->npg }}</p>
    </div>

    <!-- NOG -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>NOG:</strong> {{ $compraRequisicion->nog }}</p>
    </div>

    <!-- Proveedor Adjudicado -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>Proveedor Adjudicado:</strong> {{ $compraRequisicion->proveedorAdjudicado->nombre ?? 'Pendiente' }}</p>
    </div>

    <!-- Número Adjudicación -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>Número Adjudicación:</strong> {{ $compraRequisicion->numero_adjudicacion }}</p>
    </div>

    <!-- Estado -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>Estado:</strong> {{ $compraRequisicion->estado->nombre ?? 'Pendiente' }}</p>
    </div>

    <!-- Subproductos -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>Subproductos:</strong> {{ $compraRequisicion->subproductos }}</p>
    </div>

    <!-- Partidas -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>Partidas:</strong> {{ $compraRequisicion->partidas }}</p>
    </div>

    <!-- Observaciones -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>Observaciones:</strong> {{ $compraRequisicion->observaciones }}</p>
    </div>

    <!-- Justificación -->
    <div class="col-md-6">
        <p class="mb-1 lh-1"><strong>Justificación:</strong> {{ $compraRequisicion->justificacion }}</p>
    </div>
</div>
