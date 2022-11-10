<div class="form-row" id="campos_activos">

    <div class="form-group col-sm-6">
        {!! Form::label('nombre', 'Nombre:') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 255]) !!}
    </div>

    <!-- Codigo Inventario Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('codigo_inventario', 'Codigo Inventario:') !!}
        {!! Form::text('codigo_inventario', null, ['class' => 'form-control','maxlength' => 100]) !!}
    </div>

    <!-- Folio Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('folio', 'Folio:') !!}
        {!! Form::text('folio', null, ['class' => 'form-control','maxlength' => 100]) !!}
    </div>

    <!-- Descripcion Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('descripcion', 'Descripcion:') !!}
        {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Valor Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('valor', 'Valor:') !!}
        {!! Form::number('valor', null, ['class' => 'form-control','step' => 'any']) !!}
    </div>

    <!-- Fecha Registra Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('fecha_registro', 'Fecha Registra:') !!}
        {!! Form::date('fecha_registro', null, ['class' => 'form-control','id'=>'fecha_registro']) !!}
    </div>


    <!-- Tipo Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('tipo_id', 'Tipo:') !!}
        <multiselect v-model="tipo" :options="tipos" label="nombre" placeholder="Seleccione uno..." >
        </multiselect>
        <input type="hidden" name="tipo_id" :value="tipo ? tipo.id : null">
    </div>

    <!-- Estado Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('estado_id', 'Estado:') !!}

        <multiselect v-model="estado" :options="estados" label="nombre" placeholder="Seleccione uno..." >
        </multiselect>
        <input type="hidden" name="estado_id" :value="estado ? estado.id : null">
    </div>

    <div class="form-group col-sm-6">
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

            tipos: @json(\App\Models\ActivoTipo::all() ?? []),
            tipo: @json($activo->tipo ?? null),

            estados: @json(\App\Models\ActivoEstado::all() ?? []),
            estado: @json($activo->estado ?? null),

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
