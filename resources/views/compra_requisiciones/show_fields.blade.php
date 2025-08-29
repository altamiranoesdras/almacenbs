<div class="row mb-2">

    <!-- Tipo Concurso -->
    <div class="col-5">
        <p class="mb-1 lh-1"><strong>Estado:</strong> {{ $requisicion->estado->nombre ?? 'Pendiente' }}</p>

        <p class="mb-1 lh-1"><strong>Tipo Concurso:</strong> {{ $requisicion->tipoConcurso->nombre ?? 'Pendiente' }}</p>
        <p class="mb-1 lh-1"><strong>Tipo Adquisición:</strong> {{ $requisicion->tipoAdquisicion->nombre ?? 'Pendiente' }}</p>
        <p class="mb-1 lh-1"><strong>NPG:</strong> {{ $requisicion->npg }}</p>
        <p class="mb-1 lh-1"><strong>NOG:</strong> {{ $requisicion->nog }}</p>

    </div>


    <!-- Proveedor Adjudicado -->
    <div class="col-5">
        <p class="mb-1 lh-1"><strong>Código:</strong> {{ $requisicion->codigo }}</p>
        <p class="mb-1 lh-1"><strong>Proveedor Adjudicado:</strong> {{ $requisicion->proveedorAdjudicado->nombre ?? 'Pendiente' }}</p>
        <p class="mb-1 lh-1"><strong>Número Adjudicación:</strong> {{ $requisicion->numero_adjudicacion }}</p>

        <p class="mb-1 lh-1"><strong>Código Consolidación:</strong> {{ $requisicion->codigo_consolidacion }}</p>
{{--        <p class="mb-1 lh-1"><strong>Observaciones:</strong> {{ $requisicion->observaciones }}</p>--}}
        <p class="mb-1 lh-1"><strong>Justificación:</strong> {{ $requisicion->justificacion }}</p>
    </div>

</div>
