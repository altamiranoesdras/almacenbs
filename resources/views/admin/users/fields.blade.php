<div class="row" id="campos_usuario">
    <!-- Username Field -->
    <div class="col-sm-6 mb-1">
        {!! Form::label('username', 'Usuario:') !!}
        {!! Form::text('username', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Name Field -->
    <div class="col-sm-6 mb-1">
        {!! Form::label('name', 'Nombre:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Email Field -->
    <div class="col-sm-6 mb-1">
        {!! Form::label('email', 'Correo:') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>


    <!-- Password Field -->
    <div class="col-sm-6 mb-1">
        {!! Form::label('password', 'Contraseña:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <!-- Avatar Field -->
    <div class="col-sm-6 mb-1">
        {!! Form::label('avatar', 'Avatar:') !!}
        <input type="file" name="avatar" class="form-control" >
    </div>


    <div class="col-sm-12 mb-1">
        <div class="table-responsive">

            <dual-listbox-roles
                :fuente="roles"
                :destino="roles_asignados"
                label="name"
            >

            </dual-listbox-roles>
        </div>
    </div>


    <div class="col-sm-12 mb-1">
        <div class="table-responsive">

            <dual-listbox-permisos
                :fuente="permisos"
                :destino="permisos_asignados"
                label="name"
            >

            </dual-listbox-permisos>
        </div>
    </div>


    <div class="col-sm-12 mb-1">

        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Opciones del menu</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="col-sm-12 mb-1">
                    <div id="jstree-ajax"></div>
                    <div id="event_result"></div>
                    <input type="hidden" name="options" id="options">
                </div>
            </div>
            <!-- /.card-body -->
        </div>

    </div>
</div>

@push('scripts')
<script>
    const app = new Vue({
        el: '#campos_usuario',
        name: '#campos_usuario',
        created() {

        },
        data: {
            roles : @json(\App\Models\Role::whereNotIn('id',isset($user) ? $user->roles->pluck('id') :  [])->get()),
            roles_asignados : @json($user->roles ?? []),

            permisos : @json(\App\Models\Permission::whereNotIn('id',isset($user) ? $user->permissions->pluck('id') :  [])->get()),
            permisos_asignados : @json($user->permissions ?? []),
        },
        methods: {

        }
    });
</script>
@endpush


@push('scripts')
    <script>
        $(function () {

            $('#jstree-ajax').jstree({
                core: {
                    data: {
                        url: "{{route('api.options.index')}}?parentes=1&no_dev=1",
                        dataType: 'json',
                        data: function (node) {
                            return {
                                id: node.id
                            };
                        }
                    }
                },
                plugins: ['types', 'checkbox'],
                types: {
                    default: {
                        icon: 'far fa-folder'
                    },
                    html: {
                        icon: 'fab fa-html5 text-danger'
                    },
                    css: {
                        icon: 'fab fa-css3-alt text-info'
                    },
                    img: {
                        icon: 'far fa-file-image text-success'
                    },
                    js: {
                        icon: 'fab fa-node-js text-warning'
                    }
                }
            }).on('changed.jstree', function (e, data) {

                $("#options").val(data.selected);
            }).on('ready.jstree', function (e, data) {

                @isset($user)
                @foreach($user->options as $op)
                $.jstree.reference('#jstree-ajax')
                    .select_node('{{$op->id}}');
                @endforeach
                @endisset

            });


        })
    </script>
@endpush

