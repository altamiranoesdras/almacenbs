<ul class="list-group">
    <li class="list-group-item pb-0 pl-2 pr-2">
        <div class="form-group col-sm-12">
            <select-colaborador v-model="colaborador_origen" label="Colaborador Origen" :name="'colaborador_origen'"></select-colaborador>
        </div>
    </li>

    <li class="list-group-item pb-0 pl-2 pr-2">
        <div class="form-group col-sm-12">
            <select-colaborador v-model="colaborador_destino" label="Colaborador Destino" :name="'colaborador_destino'"></select-colaborador>
        </div>
    </li>

    <input type="hidden" name="unidad_origen" v-model="unidad_origen">
    <input type="hidden" name="unidad_destino" v-model="unidad_destino">

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
                <h4 class="modal-title">PROCESAR SOLICITUD ACTIVOS!</h4>
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
                <h4 class="modal-title">Cancelar Solicitud Activos!</h4>
            </div>
            <div class="modal-body">
                Seguro que desea cancelar la solicitud?
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

{{--<!-- Tarjeta Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('tarjeta_id', 'Tarjeta Id:') !!}--}}
{{--    {!! Form::number('tarjeta_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Tipo Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('tipo_id', 'Tipo Id:') !!}--}}
{{--    {!! Form::number('tipo_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Codigo Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('codigo', 'Codigo:') !!}--}}
{{--    {!! Form::text('codigo', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}--}}
{{--</div>--}}

{{--<!-- Correlativo Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('correlativo', 'Correlativo:') !!}--}}
{{--    {!! Form::number('correlativo', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Usuario Origen Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('usuario_origen', 'Usuario Origen:') !!}--}}
{{--    {!! Form::number('usuario_origen', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Usuario Destino Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('usuario_destino', 'Usuario Destino:') !!}--}}
{{--    {!! Form::number('usuario_destino', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Usuario Autoriza Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('usuario_autoriza', 'Usuario Autoriza:') !!}--}}
{{--    {!! Form::number('usuario_autoriza', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Usuario Inventario Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('usuario_inventario', 'Usuario Inventario:') !!}--}}
{{--    {!! Form::number('usuario_inventario', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Unidad Origen Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('unidad_origen', 'Unidad Origen:') !!}--}}
{{--    {!! Form::number('unidad_origen', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Unidad Destino Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('unidad_destino', 'Unidad Destino:') !!}--}}
{{--    {!! Form::number('unidad_destino', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Observaciones Field -->--}}
{{--<div class="form-group col-sm-12 col-lg-12">--}}
{{--    {!! Form::label('observaciones', 'Observaciones:') !!}--}}
{{--    {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Estado Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('estado_id', 'Estado Id:') !!}--}}
{{--    {!! Form::number('estado_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}
