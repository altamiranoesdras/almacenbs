<div class="table-responsive">
    <table width="100%"  class="table table-bordered table-xtra-condensed" id="tablaDetalle" style="margin-bottom: 2px">
        <thead>
        <tr class="bg-primary text-sm" align="center" style="font-weight: bold">
            <td width="20%">Producto</td>
            <td width="20%">Tipo</td>
            <td width="20%">Estado Bien</td>
            <td width="5%">-</td>
        </tr>
        </thead>
        <tbody>
        <tr v-if="detalles.length==0">
            <td colspan="6"><span class="help-block text-center">No se ha agregado ningún artículo</span></td>
        </tr>
        <tr v-for="detalle in detalles" class="text-sm">
            <td v-text="detalle.activo.nombre"></td>
            <td v-text="detalle.activo_tipo.nombre"></td>
            <td v-text="detalle.estado_del_bien"></td>
            <td width="10px">
{{--                <button type="button" class="btn btn-info btn-xs" @click="editDet(detalle)">--}}
{{--                    <i class="fa fa-edit"></i>--}}
{{--                </button>--}}
                <button type="button" class='btn btn-danger btn-xs' @click="deleteItem(detalle)" :disabled="(idEliminando===detalle.id)">
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

    </table>
</div>
