<ul class="list-group">
    <li class="list-group-item pb-0 pl-2 pr-2">
        <div class="form-group col-sm-12">
            <label for="proveedores" class="control-label">
                Proveedor:
                <a  data-toggle="modal" href="#modal-form-proveedores" tabindex="1000">Nuevo</a>
            </label>


            {!!
                Form::select(
                    'proveedor_id',
                    select(\App\Models\Proveedor::class,'nombre','id',null,null)
                    , null
                    , ['id'=>'models','class' => 'form-control select2-simple','style'=>'width: 100%']
                )
            !!}
        </div>
    </li>


    <!--            Total
    ------------------------------------------------------------------------>
    <li class="list-group-item pt-1 pb-1 text-bold ">
        <div class="row">
            <div class="col-sm-7 pl-1">
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Descuento %</span>
                    </div>
                    <input type="number" name="descuento" v-model="descuento" class="form-control input-sm" step="any">
                </div>
            </div>
            <div class="col-sm-5 text-lg">
                Total
                <span class="float-right" >
                    {{dvs()}} <span v-text="numf(total.toFixed(cantidadDecimalesPrecio))"></span>
                </span>
            </div>
        </div>

    </li>


    <!--            Numero productos
    ------------------------------------------------------------------------>
    <li class="list-group-item pt-1 pb-1 text-bold text-md">
        Cant. Productos:
        <span class="float-right" v-text="totalitems"></span>
    </li>


    <li class="list-group-item pb-0 pl-2 pr-2">
        <div class="form-group col-sm-12">
            <div class="input-group ">
                <div class="input-group-prepend">
                    <span class="input-group-text">Tipo</span>
                </div>

                {!!
                    Form::select(
                        'tipo_id',
                        select(\App\Models\CompraTipo::class,'nombre','id',null,null)
                        , null
                        , ['id'=>'models','class' => 'form-control select2-simple','style'=>'width: 100%']
                    )
                !!}
            </div>
        </div>
    </li>
    <li class="list-group-item pb-0 pl-2 pr-2" v-show="tipoComprobante=='2'">
        <div class="form-group col-sm-12">
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

            <div class="form-group col-sm-7 py-0 m-0">
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

            <div class="form-group col-sm-5 py-0 m-0">
                Crédito
                <input type="hidden" name="credito" :value="credito ? 1 : 0">
                <span class="float-right">
                     <toggle-button v-model="credito"
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

    <li class="list-group-item pb-0 " v-show="credito">

        <div class="row">

            <div class="form-group col-sm-6 ">
                {!! Form::label('fecha_limite_credito', 'Fecha Pago:') !!}
                {!! Form::date('fecha_limite_credito', hoyDb(30), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-sm-6 ">
                {!! Form::label('fecha_ingreso_plan', 'Abono inicial:') !!}
                <input type="text" name="monto_ini" id="" class="form-control" title="Abono inicial" placeholder="Abono inicial (Opcional)" v-model="abono_ini">
            </div>
        </div>

    </li>
    <li class="list-group-item pb-0 ">

        <div class="row">

            <div class="form-group col-sm-6 ">
                {!! Form::label('fecha_doc', 'Fecha Documento:') !!}
                {!! Form::date('fecha', hoyDb(), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-sm-6 ">
                {!! Form::label('fecha_ingreso_plan', 'Fecha ingresará:') !!}
                <input type="date" name="fecha_ingreso_plan" v-model="fecha_ingreso_plan"
                       class="form-control"
                       :disabled="ingreso_inmediato">
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

            <div class="form-group col-sm-8">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="tienda_id" value="{{session('tienda')}}">

                <button type="button"  class="btn btn-outline-success btn-block" @click="procesar()">
                    <span class="glyphicon glyphicon-ok"></span> Procesar
                </button>
            </div>
            <div class="form-group col-sm-4">
                <a class="btn btn-outline-danger pull-right btn-block" data-toggle="modal" href="#modal-cancel-compra">
                    <span data-toggle="tooltip" title="Cancelar compra">Cancelar</span>
                </a>
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
				<button type="submit" class="btn btn-primary" name="procesar" value="1"  id="btn-confirma-procesar" data-loading-text="<i class='fa fa-cog fa-spin fa-1x fa-fw'></i> Procesando">SI</button>
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
