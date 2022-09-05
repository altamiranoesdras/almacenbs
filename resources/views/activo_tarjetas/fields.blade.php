<div class="form-row" id="camposTarjeta">
    <!-- Responsable Id Field -->
    <div class="form-group col-12">
        {!! Form::label('responsable_id', 'Responsable:') !!}

        <multiselect v-model="responsable" :options="responsables" label="name" track-by="id"></multiselect>
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
            responsables : @json(\App\Models\User::all() ?? []),
            responsable : @json($activoTarjeta->responsable ?? null),
        },
        methods: {

        }
    });
</script>
@endpush
