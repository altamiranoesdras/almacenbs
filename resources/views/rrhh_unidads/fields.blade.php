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
            select(\App\Models\User::jefes(), 'name')
            , $rrhhUnidad->jefe_id ?? []
            , ['id'=>'jefe_id','class' => 'form-control select2-simple','multiple','style'=>'width: 100%']
        )
    !!}
</div>

<div class="col-3 mb-1">
    <div class="d-flex flex-column">
        <label class="form-check-label mb-50" for="dev">
            Activa
        </label>
        <div class="form-check form-switch form-check-primary">
            <input type="checkbox" class="form-check-input" name="activa" id="activa" {{ ($rrhhUnidad->activa == 'si') ? ' checked' : '' }} />
            <label class="form-check-label" for="dev">
                <span class="switch-icon-left"><i data-feather="check"></i></span>
                <span class="switch-icon-right"><i data-feather="x"></i></span>
            </label>
        </div>
    </div>
</div>

<div class="col-3 mb-1">
    <div class="d-flex flex-column">
        <label class="form-check-label mb-50" for="dev">
            Solicita
        </label>
        <div class="form-check form-switch form-check-primary">
            <input type="checkbox" class="form-check-input" name="solicita" id="solicita" {{ ($rrhhUnidad->solicita == 'si') ? ' checked' : '' }} />
            <label class="form-check-label" for="dev">
                <span class="switch-icon-left"><i data-feather="check"></i></span>
                <span class="switch-icon-right"><i data-feather="x"></i></span>
            </label>
        </div>
    </div>
</div>
