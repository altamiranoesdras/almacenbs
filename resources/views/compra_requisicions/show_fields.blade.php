<div class="row mb-2">

    <!-- Tipo Concurso -->
    <div class="col-5">
        <p class="mb-1 lh-1"><strong>Estado:</strong> {{ $compraRequisicion->estado->nombre ?? 'Pendiente' }}</p>

        <p class="mb-1 lh-1"><strong>Tipo Concurso:</strong> {{ $compraRequisicion->tipoConcurso->nombre ?? 'Pendiente' }}</p>
        <p class="mb-1 lh-1"><strong>Tipo Adquisición:</strong> {{ $compraRequisicion->tipoAdquisicion->nombre ?? 'Pendiente' }}</p>
        <p class="mb-1 lh-1"><strong>NPG:</strong> {{ $compraRequisicion->npg }}</p>
        <p class="mb-1 lh-1"><strong>NOG:</strong> {{ $compraRequisicion->nog }}</p>

    </div>


    <!-- Proveedor Adjudicado -->
    <div class="col-5">
        <p class="mb-1 lh-1"><strong>Código:</strong> {{ $compraRequisicion->codigo }}</p>
        <p class="mb-1 lh-1"><strong>Proveedor Adjudicado:</strong> {{ $compraRequisicion->proveedorAdjudicado->nombre ?? 'Pendiente' }}</p>
        <p class="mb-1 lh-1"><strong>Número Adjudicación:</strong> {{ $compraRequisicion->numero_adjudicacion }}</p>

        <p class="mb-1 lh-1"><strong>Código Consolidación:</strong> {{ $compraRequisicion->codigo_consolidacion }}</p>
{{--        <p class="mb-1 lh-1"><strong>Observaciones:</strong> {{ $compraRequisicion->observaciones }}</p>--}}
        <p class="mb-1 lh-1"><strong>Justificación:</strong> {{ $compraRequisicion->justificacion }}</p>
    </div>

</div>
