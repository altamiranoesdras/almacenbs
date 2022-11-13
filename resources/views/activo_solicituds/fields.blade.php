<ul class="list-group">
    <li class="list-group-item pb-0 pl-2 pr-2">
        <div class="form-group col-sm-12">
            <select-colaborador v-model="proveedor" label="Colaborador Destino"></select-colaborador>
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
</ul>

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
