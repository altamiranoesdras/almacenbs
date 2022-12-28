<div class="form-row" id="campos_usuario">

    <!-- Username Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('username', 'Nombre Usuario:') !!}
        {!! Form::text('username', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Name Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('name', 'Nombre Personal:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Name Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('nit', 'NIT:') !!}
        {!! Form::text('nit', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Email Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('email', 'Correo Electrónico:') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>


    <!-- Password Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('password', 'Contraseña:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-4">
        <select-unidad v-model="unidad" label="Unidad"></select-unidad>
    </div>

    <div class="form-group col-sm-4">
        <select-puesto v-model="puesto" label="puesto"></select-puesto>
    </div>

    <div class="form-group col-sm-4">
        <select-puesto v-model="bodega" label="bodega"></select-puesto>
    </div>

    <!-- Avatar Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('avatar', 'Foto:') !!}
        <div class="custom-file">
            <input type="file" name="avatar" class="custom-file-input" >
            <label class="custom-file-label" for="exampleInputFile">{{__("Choose file")}}</label>
        </div>
    </div>




</div>


<div class="form-group col-sm-12">
    {!! Form::label('name', 'Roles:') !!}
            <a class="success" data-toggle="modal" href="#modal-form-roles" tabindex="1000">nuevo</a>
    {!!
        Form::select(
            'roles[]',
            select(\App\Models\Role::class,'name','id',null)
            , null
            , ['id'=>'roless','class' => 'form-control duallistbox','multiple']
        )
    !!}
</div>


<div class="form-group col-sm-12">
    {!! Form::label('name', 'Permisos:') !!}
            <a class="success" data-toggle="modal" href="#modal-form-permissions" tabindex="1000">nuevo</a>
    {!!
        Form::select(
            'permissions_user[]',
            select(\App\Models\Permission::class,'name','id',null)
            , null
            , ['class' => 'form-control duallistbox','multiple']
        )
    !!}
</div>

@push('scripts')
<script>
    const camposUsuario = new Vue({
        el: '#campos_usuario',
        created() {

        },
        data: {
            unidad : @json($user->unidad ?? \App\Models\Renglon::find(old('unidad_id')) ?? null),
            puesto : @json($user->puesto ?? \App\Models\Marca::find(old('puesto_id')) ?? null),
            bodega : @json($user->bodega ?? \App\Models\Bodega::find(old('bodega_id')) ?? null),
        },
        methods: {

        }
    });
</script>
@endpush
