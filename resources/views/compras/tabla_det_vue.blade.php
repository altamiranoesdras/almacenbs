<div class="table-responsive">
    <table width="100%"  class="table table-bordered table-xtra-condensed" id="tablaDetalle" style="margin-bottom: 2px">
        <thead>
        <tr class="bg-primary text-sm" align="center" style="font-weight: bold">
            <td width="50%">Producto</td>
            <td width="10%">Precio</td>
            <td width="10%">Cantidad</td>
            <td width="10%">Fecha V.</td>
            <td width="10%">Subtotal</td>
            <td width="20%">-</td>
        </tr>
        </thead>
        <tbody>
        <tr v-if="detalles.length==0">
            <td colspan="6"><span class="help-block text-center">No se ha agregado ningún artículo</span></td>
        </tr>
        <tr v-for="detalle in detalles" class="text-sm">
            <td>@{{ detalle.item.nombre }}</td>
            <td>{{ dvs() }}@{{ numf(detalle.precio) }}</td>
            <td>@{{ numf(detalle.cantidad) }}</td>
            <td>@{{ detalle.fecha_ven }}</td>
            <td>{{ dvs() }}@{{ numf(detalle.sub_total.toFixed(cantidadDecimalesPrecio)) }}</td>
            <td width="10px">
                {{--<button type="button" class="btn btn-info btn-xs" @click="editDet(detalle)">--}}
                    {{--<i class="fa fa-edit"></i>--}}
                {{--</button>--}}
                <button type="button" class='btn btn-danger btn-xs' @click="deleteDet(detalle)" :disabled="(idEliminando===detalle.id)">
                    <span v-show="(idEliminando===detalle.id)" >
                        <i  class="fa fa-sync-alt fa-spin"></i>
                    </span>
                    <span v-show="!(idEliminando===detalle.id)" >
                        <i class="fa fa-trash-alt"></i>
                    </span>
                </button>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="6" >
                <b>Total</b>
                <b class="pull-right" v-text="' {{ dvs() }} '+numf(total.toFixed(cantidadDecimalesPrecio))"></b>
            </td>
        </tr>

        @can('ver ganancia compra')
        <tr>
            <td colspan="6" >
                <b>Ganancia</b>
                <b class="pull-right" v-text="' {{ dvs() }} '+numf(ganancia.toFixed(cantidadDecimalesPrecio))"></b>
            </td>
        </tr>
        @endcan
        </tfoot>

    </table>
</div>
