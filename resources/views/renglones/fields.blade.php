<!-- Numero Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::number('numero', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
</div>
