<div class="form-row col-md-12" id="camposTarjeta">
    <!-- Responsable Id Field -->
    <div class="form-group col-12">
        {!! Form::label('colaborador_id', 'Responsable:') !!}

        <multiselect v-model="responsable" :options="responsables" label="name" track-by="id"></multiselect>
        <input type="hidden" name="colaborador_id" :value="responsable ? responsable.id : null">
    </div>

{{--    <div class="form-group col-4">--}}
{{--        {!! Form::label('codigo_referencia', 'Código Referencia:') !!}--}}
{{--        {!! Form::text('codigo_referencia', null, ['class' => 'form-control','maxlength' => 245]) !!}--}}
{{--    </div>--}}

</div>

@push('scripts')
<script>
    const camposTarjeta = new Vue({
        name: 'camposTarjeta',
        el: '#camposTarjeta',
        created() {

        },
        data: {
        responsables : @json(\App\Models\User::whereDoesntHave('roles', function ($q){ $q->whereIn('id', \App\Models\Role::ROLES_ADMINS); })->get() ?? []),
            responsable : @json($activoTarjeta->responsable ?? null),
        },
        methods: {

        }
    });
</script>
@endpush
