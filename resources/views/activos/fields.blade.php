<div class="form-row" id="campos_activos">

    <!-- Descripcion Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('descripcion', 'Descripcion:') !!}
        {!! Form::textarea('descripcion', null, ['class' => 'form-control','rows' => 2]) !!}
    </div>

    <!-- Codigo Inventario Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('codigo_inventario', 'Codigo Inventario:') !!}
        {!! Form::text('codigo_inventario', null, ['class' => 'form-control','maxlength' => 100]) !!}
    </div>

    <!-- Folio Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('folio', 'Folio:') !!}
        {!! Form::text('folio', null, ['class' => 'form-control','maxlength' => 100]) !!}
    </div>

    <!-- Valor Actual Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('valor_actual', 'Valor Actual:') !!}
        {!! Form::number('valor_actual', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Valor Adquisicion Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('valor_adquisicion', 'Valor Adquisicion:') !!}
        {!! Form::number('valor_adquisicion', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Valor Contabilizado Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('valor_contabilizado', 'Valor Contabilizado:') !!}
        {!! Form::number('valor_contabilizado', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Fecha Registro Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('fecha_registro', 'Fecha Registro:') !!}
        {!! Form::date('fecha_registro', null, ['class' => 'form-control','id'=>'fecha_registro']) !!}
    </div>


    <!-- Tipo Id Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('tipo_id', 'Tipo:') !!}
        <multiselect v-model="tipo" :options="tipos" label="nombre" placeholder="Seleccione uno..." >
        </multiselect>
        <input type="hidden" name="tipo_id" :value="tipo ? tipo.id : null">
    </div>

    <!-- Estado Id Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('estado_id', 'Estado:') !!}

        <multiselect v-model="estado" :options="estados" label="nombre" placeholder="Seleccione uno..." >
        </multiselect>
        <input type="hidden" name="estado_id" :value="estado ? estado.id : null">
    </div>

{{--    <!-- Detalle 1H Id Field -->--}}
{{--    <div class="form-group col-sm-4">--}}
{{--        {!! Form::label('detalle_1h_id', 'Detalle 1H Id:') !!}--}}
{{--        {!! Form::number('detalle_1h_id', null, ['class' => 'form-control']) !!}--}}
{{--    </div>--}}

    <!-- Renglon Id Field -->
    <!-- Estado Id Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('renglon_id', 'Renglon:') !!}

        <multiselect v-model="renglon" :options="renglones" label="numero" track-by="id" placeholder="Seleccione uno..." >
        </multiselect>
        <input type="hidden" name="renglon_id" :value="renglon ? renglon.id : null">
    </div>


{{--    <!-- Entidad Field -->--}}
{{--    <div class="form-group col-sm-4">--}}
{{--        {!! Form::label('entidad', 'Entidad:') !!}--}}
{{--        {!! Form::number('entidad', null, ['class' => 'form-control']) !!}--}}
{{--    </div>--}}

{{--    <!-- Unidad Ejecutadora Field -->--}}
{{--    <div class="form-group col-sm-4">--}}
{{--        {!! Form::label('unidad_ejecutadora', 'Unidad Ejecutadora:') !!}--}}
{{--        {!! Form::number('unidad_ejecutadora', null, ['class' => 'form-control']) !!}--}}
{{--    </div>--}}

    <input type="hidden" name="entidad" value="11130020">
    <input type="hidden" name="unidad_ejecutadora" value="203">

{{--    <!-- Tipo Inventario Field -->--}}
{{--    <div class="form-group col-sm-4">--}}
{{--        {!! Form::label('tipo_inventario', 'Tipo Inventario:') !!}--}}
{{--        {!! Form::number('tipo_inventario', null, ['class' => 'form-control']) !!}--}}
{{--    </div>--}}

    <!-- Codigo Sicoin Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('codigo_sicoin', 'Codigo Sicoin:') !!}
        {!! Form::text('codigo_sicoin', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>

    <!-- Codigo Donacion Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('codigo_donacion', 'Codigo Donacion:') !!}
        {!! Form::number('codigo_donacion', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Nit Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('nit', 'Nit:') !!}
        {!! Form::text('nit', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>

    <!-- Numero Documento Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('numero_documento', 'Numero Documento:') !!}
        {!! Form::text('numero_documento', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>

    <!-- Fecha Aprobado Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('fecha_aprobado', 'Fecha Aprobado:') !!}
        {!! Form::date('fecha_aprobado', null, ['class' => 'form-control','id'=>'fecha_aprobado']) !!}
    </div>


    <!-- Fecha Contabilizacion Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('fecha_contabilizacion', 'Fecha Contabilizacion:') !!}
        {!! Form::date('fecha_contabilizacion', null, ['class' => 'form-control','id'=>'fecha_contabilizacion']) !!}
    </div>

    <!-- Cur Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('cur', 'Cur:') !!}
        {!! Form::text('cur', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>

    <!-- Contabilizado Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('contabilizado', 'Contabilizado:') !!}
        {!! Form::text('contabilizado', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>

{{--    <!-- Diferencia Act Adq Field -->--}}
{{--    <div class="form-group col-sm-4">--}}
{{--        {!! Form::label('diferencia_act_adq', 'Diferencia Act Adq:') !!}--}}
{{--        {!! Form::number('diferencia_act_adq', null, ['class' => 'form-control']) !!}--}}
{{--    </div>--}}

{{--    <!-- Diferencia Act Cont Field -->--}}
{{--    <div class="form-group col-sm-4">--}}
{{--        {!! Form::label('diferencia_act_cont', 'Diferencia Act Cont:') !!}--}}
{{--        {!! Form::number('diferencia_act_cont', null, ['class' => 'form-control']) !!}--}}
{{--    </div>--}}

{{--    <!-- Diferencia Adq Cont Field -->--}}
{{--    <div class="form-group col-sm-4">--}}
{{--        {!! Form::label('diferencia_adq_cont', 'Diferencia Adq Cont:') !!}--}}
{{--        {!! Form::number('diferencia_adq_cont', null, ['class' => 'form-control']) !!}--}}
{{--    </div>--}}


    <div class="form-group col-sm-12">
        {!! Form::label('imagen', 'Imagen:') !!}
        <input type="file" name="imagen" id="imagen" class="" >
    </div>

</div>

    @push('scripts')
        <script>
            const app = new Vue({
                el: '#campos_activos',
                created() {

                },
                data: {

                    tipos: @json(\App\Models\ActivoTipo::all()  ?? []),
                    tipo: @json($activo->tipo ?? \App\Models\ActivoTipo::find(old('tipo_id')) ?? null),

                    estados: @json(\App\Models\ActivoEstado::all() ?? []),
                    estado: @json($activo->estado ?? \App\Models\ActivoEstado::find('estado_id') ?? null),

                    renglones: @json(\App\Models\Renglon::all() ?? []),
                    renglon: @json($activo->renglon ?? \App\Models\Renglon::find('renglon_id') ?? null),

                },
                methods: {

                }
            });

            $(function (){

                $("#imagen").fileinput({
                    initialPreview: @json(isset($activo) ? $activo->img : ''),
                    theme: "fa",
                    maxFileCount: 1,
                    maxFileSize: 15000,
                    overwriteInitial: true, // append files to initial preview
                    showUpload: false, // hide upload button
                    browseOnZoneClick: true,
                    initialPreviewAsData: true,
                    allowedPreviewTypes: ["image"],
                    allowedFileTypes: ["image"],
                });

            })
        </script>
@endpush
