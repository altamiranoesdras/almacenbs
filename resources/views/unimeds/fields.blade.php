<!-- Magnitude Id Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('magnitud_id','Magnitud:') !!}
    {!!
        Form::select(
            'magnitud_id',
            select(\App\Models\Magnitud::class,'nombre','id',null,null)
            , null
            , ['id'=>'magnitudes','class' => 'form-control select2-simplge','style'=>'width: 100%']
        )
    !!}
</div>

<div class="col-sm-12 mb-1" style="padding: 0px; margin: 0px"></div>


<!-- Nombre Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
</div>


<!-- Simbolo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('simbolo', 'Simbolo:') !!}
    {!! Form::text('simbolo', null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10,'maxlength' => 10]) !!}
</div>
