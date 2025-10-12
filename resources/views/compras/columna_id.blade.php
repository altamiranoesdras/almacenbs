{{$compra->id}}


{{-- Modal para mostrar detalles de compra --}}
@include('compras.partials.modal_show', ['compra' => $compra])

{{-- Modal para anular compra --}}
@include('compras.partials.modal_anular', ['compra' => $compra])

{{-- Modal para cancelar compra --}}
@include('compras.partials.modal_cancelar', ['compra' => $compra])
