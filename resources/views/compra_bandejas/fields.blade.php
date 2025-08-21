
<div id="campos_permisos">
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
        {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>

    <div class="col-sm-12 mb-1 col-lg-12">
        {!! Form::label('descripcion', 'Descripcion:') !!}
        {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
    </div>

    <div class="col-sm-12 mb-1">
        <div class="table-responsive">

            <dual-listbox-compra-requisicion-estados
                :fuente="permisos"
                :destino="permisos_asignados"
                label="name"
            >

            </dual-listbox-compra-requisicion-estados>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        const app = new Vue({
            el: '#campos_permisos',
            name: '#campos_permisos',
            created() {

            },
            data: {
                {{--permisos: @json(\App\Models\Permission::whereNotIn('id',isset($role) ? $role->permissions->pluck('id') :  [])->get()),--}}
                permisos: [],
                permisos_asignados: @json($role->permissions ?? []),
            },
            methods: {}
        });
    </script>
@endpush
