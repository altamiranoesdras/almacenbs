<div class="row col-md-12" id="camposTarjeta">
    <!-- Responsable Id Field -->
    <div class="form-group col-8">
        {!! Form::label('colaborador_id', 'Responsable:') !!}

        <multiselect v-model="responsable" :options="responsables" label="text" track-by="id"></multiselect>
        <input type="hidden" name="colaborador_id" :value="responsable ? responsable.id : null">
    </div>

    <div class="form-group col-4">
        {!! Form::label('codigo_interno', 'Código Referencia:') !!}
        {!! Form::text('codigo_interno', null, ['class' => 'form-control','maxlength' => 245]) !!}
    </div>

</div>

@push('scripts')
<script>
    const camposTarjeta = new Vue({
        name: 'camposTarjeta',
        el: '#camposTarjeta',
        created() {

        },
        data: {
            responsables : @json(\App\Models\Colaborador::all() ?? []),
            responsable : @json($tarjeta->responsable ?? null),
        },
        methods: {

        }
    });
</script>
@endpush
