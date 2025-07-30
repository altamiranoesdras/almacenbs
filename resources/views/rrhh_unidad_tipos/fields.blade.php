<!-- Nombre Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Nivel Field -->
<div class="col-sm-6 mb-1">
    <div class="form-check">
        {!! Form::hidden('nivel', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('nivel', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('nivel', 'Nivel', ['class' => 'form-check-label']) !!}
    </div>
</div>
