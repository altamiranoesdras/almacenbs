<ul class="list-group">

    <li class="list-group-item p-2">
        <!-- Observaciones Field -->

        <div class="form-group col">
            {!! Form::label('justificacion', 'Justificación:') !!}
            {!! Form::textarea('justificacion', null, ['class' => 'form-control','rows' => 4]) !!}
            <input type="hidden" name="usuario_solicita" value="{{ auth()->user()->id }}">
        </div>
    </li>


    <li class="list-group-item pb-0 pl-2 pr-2 ">
        <div class="col-sm-12 mb-1 text-center">



            <button type="button" class="btn btn-outline-danger mr-2" data-bs-toggle="modal" data-target="#modalCancelarRequisicion">
                    <i class="fa fa-ban"></i>
                    Cancelar
            </button>


            <button type="submit" class="btn btn-outline-success mr-2" >
                <i class="fa fa-save"></i>
                Guardar
            </button>



        </div>
    </li>

    @if($solicitud->puedeSolicitar())
        <li class="list-group-item pb-0 pl-2 pr-2 ">
            <div class="col-sm-12 mb-1 text-center">

                <button type="button"  class="btn btn-outline-primary" @click="procesar()">
                    <i class="fa fa-paper-plane"></i>
                    Solicitar
                </button>

            </div>
        </li>
    @endif

</ul>

<!-- Modal confirm -->
<div class="modal fade modal-info" id="modal-confirma-procesar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Solicitar requisicion!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Seguro que desea continuar?
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-default"
                    data-bs-dismiss="modal"
                >
                    NO
                </button>
                <button
                    type="submit"
                    class="btn btn-primary"
                    name="solicitar" value="1"
                >
                    SI
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal cancel -->
<div class="modal fade modal-warning" id="modalCancelarRequisicion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancelar requisición!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Seguro que desea cancelar la requisición?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                <a href="{{route('solicitudes.cancelar',$solicitud->id)}}" class="btn btn-danger">
                    SI
                </a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
