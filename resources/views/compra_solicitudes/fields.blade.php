<!-- Bodega Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('bodega_id', 'Bodega Id:') !!}
    {!! Form::number('bodega_id', null, ['class' => 'form-control']) !!}
</div>


<!-- Proveedor Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('proveedor_id', 'Proveedor Id:') !!}
    {!! Form::number('proveedor_id', null, ['class' => 'form-control']) !!}
</div>


<!-- Correlativo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('correlativo', 'Correlativo:') !!}
    {!! Form::number('correlativo', null, ['class' => 'form-control']) !!}
</div>


<!-- Codigo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control', 'maxlength' => 10, 'maxlength' => 10]) !!}
</div>


<!-- Fecha Requiere Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha_requiere', 'Fecha Requiere:') !!}
    {!! Form::text('fecha_requiere', null, ['class' => 'form-control','id'=>'fecha_requiere']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha_requiere').datepicker()
    </script>
@endpush


<!-- Observaciones Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
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


<!-- Usuario Aprueba Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('usuario_aprueba', 'Usuario Aprueba:') !!}
    {!! Form::number('usuario_aprueba', null, ['class' => 'form-control']) !!}
</div>


<!-- Usuario Administra Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('usuario_administra', 'Usuario Administra:') !!}
    {!! Form::number('usuario_administra', null, ['class' => 'form-control']) !!}
</div>
