<!-- Nombre Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="col-sm-6 mb-1">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="col-sm-6 mb-1">
    {!! Form::label('Jefe','Jefe:') !!}
    {!!
        Form::select(
            'jefe_id',
            select(\App\Models\User::class, 'name')
            , $unidad->jefe_id ?? []
            , ['id'=>'unidads','class' => 'form-control select2-simple','multiple','style'=>'width: 100%']
        )
    !!}
</div>

<div class="col-sm-6 mb-1">
    {!! Form::label('Tipo','Tipo:') !!}
    {!!
        Form::select(
            'tipo_id',
            select(\App\Models\RrhhUnidadTipo::class)
            , $unidad->tipo_id ?? []
            , ['id'=>'unidads','class' => 'form-control select2-simple','multiple','style'=>'width: 100%']
        )
    !!}
</div>

<div class="col-sm-6 mb-1">
    {!! Form::label('codigo', 'Esta Activa:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="col-sm-6 mb-1">
    {!! Form::label('codigo', 'Solicita?:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Activa Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('activa', 'Activa:') !!}
    {!! Form::text('activa', null, ['class' => 'form-control']) !!}
</div>
