<div class="row g-3 mb-2">
    <!-- Columna 1 -->
    <div class="col-md-4">
        <div class="mb-1">
            <label class="form-label mb-0">Tipo:</label>
            <div>{{ $compra->tipo->nombre ?? '' }}</div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">Proveedor:</label>
            <div>{{ $compra->proveedor->razon_social ?? '' }}</div>
        </div>

        @if(!empty($compra->serie) && !empty($compra->numero))
            <div class="mb-1">
                <label class="form-label mb-0">S/N:</label>
                <div>{{ $compra->serie }}-{{ $compra->numero }}</div>
            </div>
        @endif

        @if(!empty($compra->recibo_de_caja))
            <div class="mb-1">
                <label class="form-label mb-0">Recibo de Caja:</label>
                <div>{{ $compra->recibo_de_caja }}</div>
            </div>
        @endif
    </div>

    <!-- Columna 2 -->
    <div class="col-md-4">
        <div class="mb-1">
            <label class="form-label mb-0">Fecha Recepción:</label>
            <div>{{ fechaLtn($compra->fecha_ingreso) }}</div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">Fecha del documento:</label>
            <div>{{ fechaLtn($compra->fecha_documento) }}</div>
        </div>
    </div>

    <!-- Columna 3 -->
    <div class="col-md-4">
        <div class="mb-1">
            <label class="form-label mb-0">Estado:</label>
            <div>
                <span class="badge bg-{{$compra->color_estado}}">{{ $compra->estado->nombre ?? 'Sin estado' }}</span>
            </div>
        </div>

        <div class="mb-1">
            <label class="form-label mb-0">Observaciones:</label>
            <div>{{ $compra->observaciones }}</div>
        </div>
    </div>
</div>
