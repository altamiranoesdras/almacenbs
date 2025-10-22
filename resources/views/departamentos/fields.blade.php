<!-- Codigo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Nombre Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<!-- Region Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('region_id','Región:') !!}
    {!!
        Form::select(
            'region_id',
            select(\App\Models\Region::class)
            , null
            , ['id'=>'regions','class' => 'form-control','style'=>'width: 100%']
        )
    !!}
</div>
