<div class="row" id="app">
    <div class="col-sm-6 mb-1">

        {!! Form::label('nombre', 'Opción Superior:') !!}
        <div class="mb-3">
            <b>{{isset($parent) && $parent->id ? $parent->text : "Ninguna"}}</b>
            <input type="hidden" name="unidad_padre_id" value="{{$parent->id ?? ""}}">
            <input type="hidden" name="municipio_id" :value="municipioSeleccionado?.id">
            <input type="hidden" name="departamento_id" :value="departamentoSeleccionado?.id">
        </div>
    </div>

    <div class="col-sm-6 mb-1">
        {!! Form::label('codigo', 'Codigo:') !!}
        {!! Form::text('codigo', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>

    <div class="col-sm-6 mb-1">
        {!! Form::label('nombre', 'Nombre:') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>


    <div class="col-sm-6 mb-1">
        {!! Form::label('Tipo','Tipo:') !!}
        {!!
            Form::select(
                'unidad_tipo_id',
                select(\App\Models\RrhhUnidadTipo::class)
                , $rrhhUnidad->unidad_tipo_id ?? []
                , ['id'=>'tipo_id','class' => 'form-control select2-simple','multiple','style'=>'width: 100%']
            )
        !!}
    </div>


    <div class="col-sm-6 mb-1">
        {!! Form::label('Jefe','Jefe:') !!}
        {!!
            Form::select(
                'jefe_id',
                select(\App\Models\User::deUnidad($rrhhUnidad->id), 'name'),


                old('jefe_id', $rrhhUnidad->jefe_id ?? []),
                ['id'=>'jefe_id', 'class' => 'form-control select2-simple', 'multiple', 'style'=>'width: 100%']
            )
        !!}
    </div>

    <div class="col-sm-6 mb-1">
        {!! Form::label('Departamento','Departamento:') !!}
        <multiselect
            v-model="departamentoSeleccionado"
            :options="departamentos"
            label="nombre"
            placeholder="Seleccione uno..."
        />
    </div>

    <div class="col-sm-6 mb-1">
        {!! Form::label('Municipio','Municipio:') !!}
        <multiselect
            v-model="municipioSeleccionado"
            :options="municipios"
            label="nombre"
            placeholder="Seleccione uno..."
            :disabled="municipios.length === 0 || municipios === null"
        />
    </div>


    <div class="col-3 mb-1">
        <div class="d-flex flex-column">
            <label class="form-check-label mb-50" for="activa">
                Activa
            </label>
            <div class="form-check form-switch form-check-primary">
                <input type="checkbox"
                       class="form-check-input"
                       name="activa"
                       id="activa"
                       value="si"
                    {{ old('activa', $rrhhUnidad->activa ?? '') === 'si' ? 'checked' : '' }} />
                <label class="form-check-label" for="activa">
                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                </label>
            </div>
        </div>
    </div>

    <div class="col-3 mb-1">
        <div class="d-flex flex-column">
            <label class="form-check-label mb-50" for="solicita">
                Solicita
            </label>
            <div class="form-check form-switch form-check-primary">
                <input type="checkbox"
                       class="form-check-input"
                       name="solicita"
                       id="solicita"
                       value="si"
                    {{ old('solicita', $rrhhUnidad->solicita ?? '') === 'si' ? 'checked' : '' }} />
                <label class="form-check-label" for="solicita">
                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                </label>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        const vue = new Vue({
            el: '#app',
            data: {
                departamentos: [],
                departamentoSeleccionado: null,
                municipios: [],
                municipioSeleccionado: null,
            },
            mounted() {
                this.getDepartamentos();
            },
            methods: {
                async getDepartamentos() {
                    try {
                        let res = await axios.get(route('api.departamentos.index', {con_municipios: 1}));
                        this.departamentos = res.data.data;
                    } catch (e) {
                        console.error(e);
                    }
                }
            },
            watch: {
                departamentoSeleccionado(newVal) {
                    this.municipios = [];
                    this.municipioSeleccionado = null;
                    let departamento = this.departamentos.find(dep => dep.id === newVal?.id);
                    if (departamento) {
                        this.municipios = departamento.municipios;
                    }
                }
            }
        });
    </script>
@endpush
