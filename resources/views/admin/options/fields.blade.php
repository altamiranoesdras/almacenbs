<div class="col-sm-6 mb-1">

    {!! Form::label('nombre', 'Opción Superior:') !!}
    <div class="form-group">
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
