<div class="row" id="camposOpcion">
    <div class="col-sm-6 mb-1">

        {!! Form::label('nombre', 'Opción Superior:') !!}
        <div class="mb-3">
            {{$parent->nombre ?? "Ninguna"}}
            <input type="hidden" name="option_id" value="{{$parent->id ?? ""}}">

        </div>
    </div>

    <div class="col-sm-6 mb-1">
        {!! Form::label('nombre', 'Nombre:') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
    </div>


    <div class="col-sm-6 mb-1">
        {!! Form::label('descripcion', 'Descripcion:') !!}
        {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
    </div>

    <div class="col-sm-6 mb-1">
        {!! Form::label('ruta', 'Ruta:') !!}
        {!! Form::text('ruta', null, ['class' => 'form-control']) !!}
    </div>

    <div class="col-6 mb-1">
        {!! Form::label('ruta', 'Icono izquierdo:') !!} <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">fontawesome</a>
        {!! Form::text('icono_l', $option->icono_l ?? 'fa-circle-notch', ['class' => 'form-control input-icon']) !!}

    </div>

    <div class="col-6 mb-1">

        {!! Form::label('ruta', 'Icono derecho:') !!} <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">fontawesome</a>
        {!! Form::text('icono_r', null, ['class' => 'form-control input-icon']) !!}

    </div>

    <div class="col-6 mb-1">
        {!! Form::label('color', 'Color:') !!}
        <multiselect
            v-model="color_seleccionado"
            :options="colores"
            placeholder="Selecciona un color"
            name="color">

            {{-- cómo se ve cada opción en el desplegable --}}
            <template slot="option" slot-scope="{ option }">
                <span class="color-dot" :style="{ backgroundColor: getColorHex(option) }"></span>
                <span>@{{ option }}</span>
            </template>

            {{-- cómo se ve el valor seleccionado --}}
            <template slot="singleLabel" slot-scope="{ option }">
                <span class="color-dot" :style="{ backgroundColor: getColorHex(option) }"></span>
                <span>@{{ option }}</span>
            </template>
        </multiselect>

        {{-- lo que realmente se envía en el form --}}
        <input type="hidden" name="color" :value="color_seleccionado">
    </div>

    <!--switch para dev -->
    <div class="col-3 mb-1">
        <div class="d-flex flex-column">
            <label class="form-check-label mb-50" for="dev">
                Para desarrolladores
            </label>
            <div class="form-check form-switch form-check-primary">
                <input type="checkbox" class="form-check-input" name="dev" id="dev" {{ ($option->dev ?? false) ? ' checked' : '' }} />
                <label class="form-check-label" for="dev">
                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                </label>
            </div>
        </div>
    </div>

    <!--switch para recursos -->
    <div class="col-3 mb-1">
        <div class="d-flex flex-column">
            <label class="form-check-label mb-50" for="recursos">
                De recursos
            </label>
            <div class="form-check form-switch form-check-primary">
                <input type="checkbox" class="form-check-input" name="recursos" id="recursos" {{ ($option->recursos ?? false) ? ' checked' : '' }} />
                <label class="form-check-label" for="recursos">
                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                </label>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const app = new Vue({
        el: '#camposOpcion',
        name: 'camposOpcion',
        created() {

        },
        data: {
            colores : ['info', 'primary', 'success', 'warning', 'danger', 'secondary', 'dark'],
            color_seleccionado: @json($option->color ?? '')
        },
        methods: {
            getColorHex(name) {
                switch (name) {
                    case 'info':      return '#0dcaf0';
                    case 'primary':   return '#0d6efd';
                    case 'success':   return '#198754';
                    case 'warning':   return '#ffc107';
                    case 'danger':    return '#dc3545';
                    case 'secondary': return '#6c757d';
                    case 'dark':      return '#343a40';
                    default:          return '#6c757d';
                }
            }
        }
    });
</script>
@endpush

@push('estilos')
    <style>
        .color-dot {
            display: inline-block;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            margin-right: 6px;
            border: 1px solid #ccc;
        }
    </style>
@endpush
