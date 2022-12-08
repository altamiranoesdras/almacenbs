<!-- Colaborador Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('colaborador_id', 'Colaborador Id:') !!}
    {!! Form::number('colaborador_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Unidad Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unidad_id', 'Unidad Id:') !!}
    {!! Form::number('unidad_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Puesto Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('puesto_id', 'Puesto Id:') !!}
    {!! Form::number('puesto_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Numero Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Inicio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inicio', 'Inicio:') !!}
    {!! Form::text('inicio', null, ['class' => 'form-control','id'=>'inicio']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#inicio').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Fin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fin', 'Fin:') !!}
    {!! Form::text('fin', null, ['class' => 'form-control','id'=>'fin']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fin').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush