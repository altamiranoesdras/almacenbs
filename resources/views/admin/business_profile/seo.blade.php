
<div class="col-sm-6 mb-1">
    {!! Form::label('meta_titulo', 'Meta Titulo:') !!}
    {!! Form::text('meta_titulo', config('app.meta_titulo'), ['class' => 'form-control', 'maxlength' => 60]) !!}
</div>

<div class="col-sm-12 mb-1">
    {!! Form::label('meta_descripcion', 'Meta Descripción:') !!}
    {!! Form::textarea('meta_descripcion', config('app.meta_descripcion'), ['class' => 'form-control', 'rows' => 2]) !!}
</div>

<div class="col-sm-12 mb-1">
    {!! Form::label('meta_keywords', 'Meta Keywords:') !!}
    {!! Form::select(
            'meta_keywords[]',
             $meta_keywords,
            $meta_keywords ?? null,
            ['id' => 'meta_keywords', 'class' => 'form-control','multiple'=>"multiple",'style' => 'width: 100%']
        )
    !!}
</div>


@push('scripts')

    <script type="text/javascript">
        $(function () {

            // inicializamos el plugin
            $('#meta_keywords').select2({
                tags: true,
                tokenSeparators: [','],
            });
        });
    </script>

@endpush
