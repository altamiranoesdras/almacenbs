<ul class="list-group">
    <li class="list-group-item pb-0 pl-2 pr-2">
        <div class="col-sm-12 mb-1">
            <select-proveedor v-model="proveedor" label="Proveedor"></select-proveedor>
        </div>
    </li>


{{--    <!--            Total--}}
{{--    ------------------------------------------------------------------------>--}}
{{--    <li class="list-group-item pt-1 pb-1 text-bold ">--}}
{{--        <div class="row">--}}
{{--            <div class="col-sm-12 text-lg">--}}
{{--                Total--}}
{{--                <span class="float-right" >--}}
{{--                    {{dvs()}} <span v-text="nfp(total)"></span>--}}
{{--                </span>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </li>--}}


{{--    <!--            Numero productos--}}
{{--    ------------------------------------------------------------------------>--}}
{{--    <li class="list-group-item pt-1 pb-1 text-bold text-md">--}}
{{--        Cant. Productos:--}}
{{--        <span class="float-right" v-text="totalitems"></span>--}}
{{--    </li>--}}


    <li class="list-group-item pb-0 pl-2 pr-2">
        <div class="col-sm-12 mb-1">
            <select-compra-tipo v-model="tipo" label="Tipo"></select-compra-tipo>
        </div>
    </li>
    <li class="list-group-item pb-0 pl-2 pr-2" v-show="esFactura">
        <div class="col-sm-12 mb-1">
            <div class="input-group ">
                <div class="input-group-prepend">
                    <span class="input-group-text">S</span>
                </div>
                {!! Form::text('serie', null, ['class' => 'form-control','placeholder'=>'Serie']) !!}
                <div class="input-group-prepend">
                    <span class="input-group-text">N</span>
                </div>
                {!! Form::text('numero', null, ['class' => 'form-control','placeholder'=>'Número']) !!}
            </div>

        </div>
    </li>



    <li class="list-group-item pb-0 pt-1  text-bold ">
        <div class="row ">

            <div class="col-sm-7 mb-1 py-0 m-0">
                Ingreso inmediato
                <input type="hidden" name="ingreso_inmediato" :value="ingreso_inmediato ? 1 : 0">
                <span class="float-right">
                     <toggle-button v-model="ingreso_inmediato"
                                    :sync="true"
                                    :labels="{checked: 'SI', unchecked: 'NO'}"
                                    :height="25"
                                    :width="50"
                                    :value="false"
                     />
                </span>
            </div>

        </div>

    </li>


    <li class="list-group-item pb-0 ">

        <div class="row">

            <div class="col-sm-6 mb-1 ">
                {!! Form::label('fecha_documento', 'Fecha Documento:') !!}
                {!! Form::date('fecha_documento', hoyDb(), ['class' => 'form-control']) !!}
            </div>

            <div class="col-sm-6 mb-1 ">
                {!! Form::label('fecha_ingreso', 'Fecha Ingreso:') !!}
                {!! Form::date('fecha_ingreso', hoyDb(), ['class' => 'form-control']) !!}
            </div>

            <div class="col-sm-6 mb-1 ">
                {!! Form::label('orden_compra', 'Orden Compra:') !!}
                {!! Form::text('orden_compra', null, ['class' => 'form-control']) !!}
            </div>



        </div>



    </li>



    <!--            Observaciones
    ------------------------------------------------------------------------>
    <li class="list-group-item p-1">
        <div class="input-group">
            <textarea
                name="observaciones"
                id="observaciones"
                @focus="$event.target.select()"
                class="form-control"
                rows="2"
                placeholder="Observaciones"
            ></textarea>
        </div>
    </li>


    <li class="list-group-item pb-0 pl-2 pr-2">

        <div class="row">

            <div class="d-grid col-sm-5 mb-1">
                <a class="btn btn-outline-danger btn-block" data-toggle="modal" href="#modal-cancel-compra">
                    <span data-toggle="tooltip" title="Cancelar compra">
                        <i class="fa fa-ban"></i>
                        Cancelar
                    </span>
                </a>
            </div>

            <div class="d-grid col-sm-7 mb-1">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                <button type="button"  class="btn btn-outline-success btn-block" @click="procesar()">
                    <i class="fa fa-check"></i>
                    Procesar
                </button>
            </div>

        </div>


    </li>
</ul>

<!-- Modal confirm -->
<div class="modal fade modal-info" id="modal-confirma-procesar">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
                <h4 class="modal-title">PROCESAR COMPRA!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				Seguro que desea continuar?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                <button type="submit" class="btn btn-primary" name="procesar" value="1"  onclick="esperar()">SI</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal cancel -->
<div class="modal fade modal-warning" id="modal-cancel-compra">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cancelar compra!</h4>
            </div>
            <div class="modal-body">
                Seguro que desea cancelar la compra?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                <a href="{{route('compras.destroy',$temporal->id)}}" class="btn btn-danger">
                    SI
                </a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
