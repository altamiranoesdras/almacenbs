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
    {!! Form::select('color', ['info','primary', 'success', 'warning', 'danger', 'secondary', 'dark'], null, ['class' => 'form-control']) !!}
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
