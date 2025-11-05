<table class="table table-bordered table-hover table-xtra-condensed" id="table-detalles-{{ $solicitud->id }}">
    <thead>
    <tr>
        <th>Insumo</th>
        <th>Tu Stock</th>
        <th>Cantidad Solicitada</th>
        <th>Cantidad Autorizada</th>
        <th>Cantidad despachada</th>
        {{-- <th></th> --}}
    </tr>
    </thead>
    <tbody>

    @foreach($solicitud->detalles as $det)
        <tr>
            <td>{{$det->item->text}}</td>
            <th>{{$det->item->stock_total}}</th>
            <td>{{$det->cantidad_solicitada}}</td>
            <td> {{$det->cantidad_autorizada}}</td>
            @if( $solicitud->estaDespachada())
                <td> {{$det->cantidad_despachada}}</td>
            @else
            <td>
                <input type="number" name="cantidades_despacha[]" step="any" class="form-control form-control-sm" required value="{{ $det->cantidad_autorizada }}" >
            </td>
            @endif
        </tr>
    @endforeach

{{--    <tr v-for="detalle in detalles">--}}
{{--        <td v-text="detalle.item.text"></td>--}}
{{--        <th v-text="detalle.item.stock_total"></th>--}}
{{--        <td v-text="detalle.cantidad_solicitada"></td>--}}
{{--        <td v-text="detalle.cantidad_autorizada"></td>--}}
{{--        <td>--}}
{{--            <input type="number" name="cantidades_despacha[]" step="any" class="form-control form-control-sm" required v-model="detalle.cantidad_real">--}}
{{--        </td>--}}
{{--        --}}{{-- <td>--}}
{{--            <div class="btn btn-primary" @click="completar(detalle)">--}}
{{--                ok--}}
{{--            </div>--}}
{{--        </td> --}}
{{--    </tr>--}}

    </tbody>
    <tfoot>
    <tr>
        <th colspan="5"><span class="pull-right">
                TOTAL Artículos
                {{nf($solicitud->detalles->sum('cantidad_solicitada'))}}
            </span>
        </th>
    </tr>
    </tfoot>
</table>


{{-- @push('scripts') --}}
{{--    <script >--}}
{{--        new Vue({--}}
{{--            el: '#table-detalles-{{ $solicitud->id }}',--}}
{{--            created() {--}}
{{--                this.detalles.forEach(det => {--}}
{{--                    det.cantidad_real = 0;--}}
{{--                });--}}
{{--            },--}}
{{--            data: {--}}
{{--                detalles: @json($solicitud->detalles)--}}
{{--            },--}}
{{--            methods: {--}}
{{--                completar(detalle) {--}}
{{--                    this.$set(detalle, 'cantidad_real', detalle.cantidad_autorizada);--}}
{{--                    console.log('completar', detalle);--}}
{{--                }--}}
{{--            },--}}
{{--            computed:{--}}

{{--            },--}}
{{--            watch:{--}}

{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{-- @endpush --}}

