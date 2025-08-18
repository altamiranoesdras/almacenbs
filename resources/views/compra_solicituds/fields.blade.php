<!-- Bodega Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('bodega_id', 'Bodega Id:') !!}
    {!! Form::number('bodega_id', null, ['class' => 'form-control']) !!}
</div>


<!-- Unidad Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('unidad_id', 'Unidad Id:') !!}
    {!! Form::number('unidad_id', null, ['class' => 'form-control']) !!}
</div>


<!-- Correlativo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correlativo', 'Correlativo:') !!}
    {!! Form::number('correlativo', null, ['class' => 'form-control']) !!}
</div>


<!-- Codigo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control', 'maxlength' => 10, 'maxlength' => 10, 'maxlength' => 10]) !!}
</div>


<!-- Fecha Solicita Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha_solicita', 'Fecha Solicita:') !!}
    {!! Form::text('fecha_solicita', null, ['class' => 'form-control','id'=>'fecha_solicita']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#fecha_solicita').datepicker()
    </script>
@endpush


<!-- Justificacion Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('justificacion', 'Justificacion:') !!}
    {!! Form::textarea('justificacion', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>


<!-- Estado Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    {!! Form::number('estado_id', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Usuario Solicita Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('usuario_solicita', 'Usuario Solicita:') !!}
    {!! Form::number('usuario_solicita', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Usuario Verifica Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('usuario_verifica', 'Usuario Verifica:') !!}
    {!! Form::number('usuario_verifica', null, ['class' => 'form-control']) !!}
</div>
