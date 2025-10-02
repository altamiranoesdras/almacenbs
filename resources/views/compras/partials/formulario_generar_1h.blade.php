@php
    $envioFiscal = \App\Models\EnvioFiscal::where('nombre_tabla', 'compras')->where('activo', 'si')->first();
@endphp

@if($envioFiscal != null && $envioFiscal->correlativo_actual <= $envioFiscal->correlativo_al)
    <form action="{{route('bandejas.compras1h.operador.genera1h',$compra->id)}}" method="post" class="esperar">
        @csrf
        <div class="row">
            <div class="col-sm-4 mb-1">
                <div class="mt-1">
                    <button type="submit" id="generar" class="btn btn-outline-primary">
                        <i class="fa fa-gears"></i>
                        Generar 1H
                    </button>
                </div>
            </div>
        </div>
    </form>
@else
    <div class="alert alert-danger p-2" role="alert">
        No se puede generar 1H. El folio actual ha alcanzado el folio final.
    </div>
@endif
