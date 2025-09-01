<div class="row mb-1">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-right">
        <h3>
            Folio:
            <span class="text-danger">
            {{$compra->compra1h->folio}}
            </span>
        </h3>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-1">
        @include('compras.tabla_detalles_1h',['compra' => $compra,'editable' => $editable ?? false])
    </div>

    <div class="col-md-12 mb-1">
        <label>Observaciones:</label>
        @if($editable ?? false)
            <textarea class="form-control" name="observaciones" rows="2" cols="2">{{ $compra->compra1h->observaciones }}</textarea>
        @else
            {{ $compra->compra1h->observaciones }}
        @endif
    </div>
</div>
