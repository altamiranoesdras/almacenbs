
<div class="row" id="campos_estados">
    <div class="col-sm-6 mb-1">
        {!! Form::label('rol_id','Rol:') !!}
        {!!
            Form::select(
                'rol_id',
                select(\App\Models\Role::class,'name')
                , null
                , ['id'=>'rol_ids','class' => 'form-control','style'=>'width: 100%']
            )
        !!}
    </div>

    <div class="col-sm-6 mb-1">
        {!! Form::label('nombre', 'Nombre:') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
    </div>

    <div class="col-sm-12 mb-1 col-lg-12">
        {!! Form::label('descripcion', 'Descripcion:') !!}
        {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => 3]) !!}
    </div>

    <div class="col-sm-12 mb-1">
        <div class="table-responsive">

            <dual-listbox-compra-requisicion-estados
                :fuente="estados"
                :destino="estados_asignados"
                label="nombre"
            >

            </dual-listbox-compra-requisicion-estados>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        const app = new Vue({
            el: '#campos_estados',
            name: '#campos_estados',
            created() {

            },
            data: {
                estados: @json(\App\Models\CompraRequicicionEstado::whereNotIn('id',isset($compraBandeja) ? $compraBandeja->estados->pluck('id') :  [])->get()),
                // estados: [],
                estados_asignados: @json($compraBandeja->estados ?? []),
            },
            methods: {}
        });
    </script>
@endpush
