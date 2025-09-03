<div class="row g-3 mb-2">
    <!-- Columna 1 -->
    <div class="col-md-4">
        <div class="mb-1">
            <label class="form-label mb-0">Tipo:</label>
            <div><span class="fw-bold">{{ $compra->tipo->nombre ?? '' }}</span></div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">Proveedor:</label>
            <div><span class="fw-bold">{{ $compra->proveedor->razon_social ?? '' }}</span></div>
        </div>

        @if(!empty($compra->serie) && !empty($compra->numero))
            <div class="mb-1">
                <label class="form-label mb-0">S/N:</label>
                <div><span class="fw-bold">{{ $compra->serie }}-{{ $compra->numero }}</span></div>
            </div>
        @endif

        @if(!empty($compra->recibo_de_caja))
            <div class="mb-1">
                <label class="form-label mb-0">Recibo de Caja:</label>
                <div><span class="fw-bold">{{ $compra->recibo_de_caja }}</span></div>
            </div>
        @endif
    </div>

    <!-- Columna 2 -->
    <div class="col-md-4">
        <div class="mb-1">
            <label class="form-label mb-0">Folio 1H:</label>
            <div><span class="fw-bold">{{ $compra->compra1h->folio ?? 'Sin 1H'}}</span></div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">Fecha Recepción:</label>
            <div><span class="fw-bold">{{ fechaLtn($compra->fecha_ingreso) }}</span></div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">Fecha del documento:</label>
            <div><span class="fw-bold">{{ fechaLtn($compra->fecha_documento) }}</span></div>
        </div>
    </div>

    <!-- Columna 3 -->
    <div class="col-md-4">
        <div class="mb-1">
            <label class="form-label mb-0">Estado:</label>
            <div>
                <span class="badge bg-{{ $compra->color_estado }} fw-bold">
                    {{ $compra->estado->nombre ?? 'Sin estado' }}
                </span>
            </div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0"># Orden de Compra:</label>
            <div>
                <span class="fw-bold">{{ $compra->orden_compra ?? 'Sin orden' }}</span>
            </div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">Observaciones:</label>
            <div><span class="fw-bold">{{ $compra->observaciones }}</span></div>
        </div>
    </div>
</div>
