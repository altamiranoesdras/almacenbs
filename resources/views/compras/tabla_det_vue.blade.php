<div class="table-responsive">
    <table  class="table table-bordered table-sm table-striped" id="tablaDetalle" style="margin-bottom: 2px">
        <thead>
        <tr class="text-sm">
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
            <td v-text="detalle.item.text"></td>
            <td v-text="dvs + nfp(detalle.precio)"></td>
            <td v-text="nf(detalle.cantidad)"></td>
            <td v-text="detalle.fecha_vence"></td>
            <td v-text="dvs + nfp(detalle.sub_total)"></td>
            <td width="10px">
                {{--<button type="button" class="btn btn-icon btn-flat-info rounded-circle" @click="editDet(detalle)">--}}
                    {{--<i class="fa fa-edit"></i>--}}
                {{--</button>--}}
                <button type="button" class='btn btn-icon btn-flat-danger rounded-circle' @click="deleteItem(detalle)" :disabled="(idEliminando===detalle.id)">
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
            <td >
                <b>Descuento (Q)</b>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td>

                <input type="number" class="form-control" step="any" v-model="descuento" name="descuento" >
            <td>

            </td>

        </tr>
        <tr>
            <td >
                <b>Total</b>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <b class="pull-right" v-text="dvs + nfp(total)"></b>
            <td></td>

        </tr>
        </tfoot>

    </table>
</div>
