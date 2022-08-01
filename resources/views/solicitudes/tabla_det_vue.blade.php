<div class="table-responsive">
    <table width="100%"  class="table table-bordered table-xtra-condensed" id="tablaDetalle" style="margin-bottom: 2px">
        <thead>
        <tr class="bg-primary text-sm" align="center" style="font-weight: bold">
            <td width="60%">Producto</td>
            <td width="25%">Cantidad</td>
            <td width="15%">-</td>
        </tr>
        </thead>
        <tbody>
        <tr v-if="detalles.length==0">
            <td colspan="6"><span class="help-block text-center">No se ha agregado ningún artículo</span></td>
        </tr>
        <tr v-for="detalle in detalles" class="text-sm">
            <td>@{{ detalle.item.nombre }}</td>
            <td>@{{ nf(detalle.cantidad) }}</td>
            <td width="10px">
                <button type="button" class="btn btn-info btn-xs" @click="editDet(detalle)">
                    <i class="fa fa-edit"></i>
                </button>
                <button type="button" class='btn btn-danger btn-xs' @click="deleteDet(detalle)" :disabled="(idEliminando===detalle.id)">
                    <i  v-show="(idEliminando===detalle.id)" class="fa fa-spinner fa-spin"></i>
                    <i v-show="!(idEliminando===detalle.id)" class="fa fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="6" >
                <b>Total</b>
                <b class="pull-right" v-text="totalitems.toFixed(2)"></b>
            </td>
        </tr>
        </tfoot>

    </table>
</div>