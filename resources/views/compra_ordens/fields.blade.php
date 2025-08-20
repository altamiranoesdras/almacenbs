<!-- Gestion Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('gestion_id', 'Gestion Id:') !!}
    {!! Form::number('gestion_id', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Proveedor Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('proveedor_id', 'Proveedor Id:') !!}
    {!! Form::number('proveedor_id', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Numero Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control', 'required', 'maxlength' => 50, 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>


<!-- Fecha Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::text('fecha', null, ['class' => 'form-control','id'=>'fecha']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#fecha').datepicker()
    </script>
@endpush


<!-- Estado Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('estado', 'Estado:') !!}
    {!! Form::text('estado', null, ['class' => 'form-control', 'required']) !!}
</div>


<!-- Observaciones Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>
