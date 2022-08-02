<ul class="list-group">

    <li class="list-group-item p-2">
        <!-- Observaciones Field -->

        <div class="form-group col">
            {!! Form::label('observaciones', 'Observaciones:') !!}
            {!! Form::textarea('observaciones', null, ['class' => 'form-control','rows' => 4]) !!}
        </div>
    </li>


    <li class="list-group-item pb-0 pl-2 pr-2 ">
        <div class="form-group col-sm-12 text-right">


            <a class="btn btn-outline-danger mr-4" data-toggle="modal" href="#modal-cancel-compra">
                <span data-toggle="tooltip" title="Cancelar compra">
                    <i class="fa fa-ban"></i>
                    Cancelar
                </span>
            </a>

            <button type="button"  class="btn btn-outline-success float-right" @click="procesar()">

                <i class="fa fa-save"></i>
                Procesar
            </button>


        </div>
    </li>
</ul>

<!-- Modal confirm -->
<div class="modal fade modal-info" id="modal-confirma-procesar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PROCESAR SOLICITUD!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                Seguro que desea continuar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                <button type="submit" class="btn btn-primary"
                        name="procesar" value="1"  onClick="this.form.submit(); this.disabled=true;"
                        data-loading-text="<i class='fa fa-cog fa-spin fa-1x fa-fw'></i> Procesando">
                    SI
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal cancel -->
<div class="modal fade modal-warning" id="modal-cancel-compra">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancelar compra!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                Seguro que desea cancelar la requisición?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                <a href="{{route('solicitud.cancelar',$temporal->id)}}" class="btn btn-danger">
                    SI
                </a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
