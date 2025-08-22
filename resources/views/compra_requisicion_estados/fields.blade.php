<!-- Nombre Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>



<div class="col-sm-6 mb-1" id="vueSelector">
    {!! Form::label('nombre', 'Tipo Proceso:') !!}
    <multiselect
        v-model="tipoProceso"
        :options="tipoProcesos"
        :multiple="false"
        placeholder="Seleccione uno..."
    >
    </multiselect>
    <input
        type="hidden"
        name="tipo_proceso"
        :value="tipoProceso"
    >
</div>


@push('scripts')
<script>
    new Vue({
        el: '#vueSelector',
        data: {
            tipoProceso: '{{ old('tipo_proceso', $compraRequisicionEstado->tipo_proceso ?? null) }}',
            tipoProcesos: ['NPG', 'NOG']
        }
    });
</script>
@endpush
