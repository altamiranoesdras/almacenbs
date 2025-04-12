<div id="campos_permisos">
    <!-- Name Field -->
    <div class="col-sm-6 mb-1">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
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
            el: '#campos_permisos',
            name: '#campos_permisos',
            created() {

            },
            data: {
                permisos : @json(\App\Models\Permission::whereNotIn('id',isset($role) ? $role->permissions->pluck('id') :  [])->get()),
                permisos_asignados : @json($role->permissions ?? []),
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

                @isset($role)
                @foreach($role->options as $op)
                $.jstree.reference('#jstree-ajax')
                    .select_node('{{$op->id}}');
                @endforeach
                @endisset

            });


        })
    </script>
@endpush
