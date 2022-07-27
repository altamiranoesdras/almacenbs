<div class="form-group col-sm-12">
    <span class="text-danger">(*)</span> Campos obligatorios
</div>
<div class="form-group col-sm-5">
    <div class="row">
        <!-- Imagen Field -->
        <div class="form-group col-sm-12 ">
            {!! Form::label('imagen', 'Imagen:') !!}
            {!! Form::file('imagen', ['class' => 'form-control file']) !!}
        </div>
    </div>
</div>

<div class="form-group col-sm-7">
    <div class="row">

        <!-- Codigo Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('codigo', 'Codigo:') !!}
            {!! Form::text('codigo', null, ['class' => 'form-control','autofocus']) !!}
            {!! Form::hidden('iestado_id', 1) !!}
        </div>

        <!-- Nombre Field -->
        <div class="form-group col-sm-9">

            {!! Form::label('nombre', 'Nombre: ') !!}
            <span class="text-danger"> *</span>
            @if(isset($edit) && ($item->estaEnUnaCompra() || $item->estaEnUnaVenta()))
                <span class="text-sm text-warning">
        <strong>El artículo se encuentra en una o mas ventas y/o compras</strong>
        </span>
            @endif
            {!! Form::text('nombre', null, ['class' => 'form-control', isset($edit) && ($item->estaEnUnaCompra() || $item->estaEnUnaVenta())? 'readonly' : '']) !!}
        </div>

        <!-- Stock Field -->
        <div class="form-group col-sm-4"1>
            {!! Form::label('stock', 'Existencias:') !!}<span class="text-danger"> *</span>
            {!! Form::number('stock', isset($item) ? $item->stocks->sum('cantidad'): 0, ['class' => 'form-control',isset($edit) && ($item->estaEnUnaCompra() || $item->estaEnUnaVenta())? 'readonly' : '']) !!}
        </div>

        <!-- Precio Venta Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('precio_venta', 'Precio Venta:') !!}<span class="text-danger"> *</span>
            {!! Form::number('precio_venta', null, ['class' => 'form-control','step'=>".01"]) !!}
        </div>

        <!-- Precio Compra Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('precio_compra', 'Precio Compra:') !!}<span class="text-danger"> *</span>
            {!! Form::number('precio_compra', null, ['class' => 'form-control','step'=>".01"]) !!}
        </div>

        <!-- Icategoria Id Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('icatecoria_id','Categorias: ') !!}
            <a class="success" data-toggle="modal" href="#modal-form-icategorias" tabindex="1000">Nueva</a>
            {!!
                Form::select(
                    'categorias[]',
                    select(\App\Models\ItemCategoria::class,'nombre','id',null)
                    , $categoriasItem ?? null
                    , ['id'=>'icatecorias','class' => 'form-control ','multiple','style'=>'width: 100%']
                )
            !!}
        </div>
    </div>

</div>





<div class="form-group col-sm-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Información adicional</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <!-- Descripcion Field -->
                    <div class="form-group col-sm-12 col-lg-12">
                        {!! Form::label('descripcion', 'Descripcion:') !!}
                        {!! Form::textarea('descripcion', null, ['id' => 'editor','class' => '']) !!}
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <div class="row">

                        <!-- Unimed Id Field -->
                        <div class="form-group col-sm-6">
                            <label for="marca_id" class="control-label">Unidad de Medida: <a class="success" data-toggle="modal" href="#modal-form-unimeds" tabindex="1000">nueva</a></label>
                            {!!
                                Form::select(
                                    'unimed_id',
                                    \App\Models\Unimed::pluck('nombre','id')->toArray()
                                    , null
                                    , ['class' => 'form-control select2-simple',"id" => 'unimeds','multiple'=>'multiple','style'=>'width: 100%']
                                )
                            !!}
                        </div>

                        <!-- Marca Id Field -->
                        <div class="form-group col-sm-6">
                            <label for="marca_id" class="control-label">Marca: <a class="success" data-toggle="modal" href="#modal-form-marcas" tabindex="1000">nueva</a></label>
                            {!!
                                Form::select(
                                    'marca_id',
                                    \App\Models\Marca::pluck('nombre','id')->toArray(),
                                    null,
                                    ['class' => 'form-control select2-simple','id'=>'marcas','multiple'=>"multiple",'style'=>'width: 100%']
                                )
                            !!}
                        </div>

                        <!-- Ubicacion Field -->
                        <div class="form-group col-sm-4">
                            {!! Form::label('ubicacion', 'Ubicacion:') !!}
                            {!! Form::text('ubicacion', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Precio Mayoreo Field -->
                        <div class="form-group col-sm-4">
                            {!! Form::label('precio_mayoreo', 'Precio Mayoreo:') !!}
                            {!! Form::text('precio_mayoreo', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Cantidad Mayoreo Field -->
                        <div class="form-group col-sm-4">
                            {!! Form::label('cantidad_mayoreo', 'Cantidad Mayoreo:') !!}
                            {!! Form::text('cantidad_mayoreo', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- inventariable Field -->
                        <div class="form-group col-xs-6 col-sm-3">
                            {!! Form::label('inventariable', 'Inventariable:') !!}
                            <div style="width: 100%">
                                <input type="checkbox"
                                       data-toggle="toggle"
                                       data-size="normal"
                                       data-on="Si"
                                       data-off="No"
                                       data-style="ios"
                                       name="inventariable"
                                       value="1"
                                        {{( !isset($item) || (isset($item) && $item->inventariable) ) ? 'checked' : '' }}>
                            </div>
                        </div>

                        <!-- Perecedero Field -->
                        <div class="form-group col-xs-6 col-sm-3">
                            {!! Form::label('perecedero', 'Perecedero:') !!}
                            <div style="width: 100%">
                                <input type="checkbox"
                                       data-toggle="toggle"
                                       data-size="normal"
                                       data-on="Si"
                                       data-off="No"
                                       data-style="ios"
                                       name="perecedero"
                                       value="1"
                                        {{( !isset($item) || (isset($item) && $item->perecedero) ) ? 'checked' : '' }}>
                            </div>
                        </div>

                        <!-- MAteria Prima Field -->
                        <div class="form-group col-xs-6 col-sm-3">
                            {!! Form::label('materia_prima', 'Materia Prima:') !!}
                            <div style="width: 100%">
                                <input type="checkbox"
                                       data-toggle="toggle"
                                       data-size="normal"
                                       data-on="Si"
                                       data-off="No"
                                       data-style="ios"
                                       name="materia_prima"
                                       value="1"
                                        {{( !isset($item) || (isset($item) && $item->materia_prima) ) ? 'checked' : '' }}>
                            </div>
                        </div>

                        <!-- Web Prima Field -->
                        <div class="form-group col-xs-6 col-sm-3">
                            {!! Form::label('web', 'Web:') !!}
                            <div style="width: 100%">
                                <input type="checkbox"
                                       data-toggle="toggle"
                                       data-size="normal"
                                       data-on="Si"
                                       data-off="No"
                                       data-style="ios"
                                       name="web"
                                       value="1"
                                        {{( !isset($item) || (isset($item) && $item->web) ) ? 'checked' : '' }}>
                            </div>
                        </div>

                        <!-- Web Prima Field -->
                        <div class="form-group col-xs-6 col-sm-3">
                            {!! Form::label('portada', 'Portada:') !!}
                            <div style="width: 100%">
                                <input type="checkbox"
                                       data-toggle="toggle"
                                       data-size="normal"
                                       data-on="Si"
                                       data-off="No"
                                       data-style="ios"
                                       name="portada"
                                       value="1"
                                    {{( !isset($item) || (isset($item) && $item->portada) ) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>


@push('css')
    <style>
        .ck.ck-editor {
            max-width: 100%;
            max-height: 500px;
        }
        .ck-editor__editable
        {
            min-height: 11rem !important;
        }
    </style>
    @endpush
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/classic/ckeditor.js"></script>
    <script type="text/javascript">
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                removePlugins: [ 'Heading', 'Link' ],
                toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ],
                minHeight: '800px'
            } )
            .catch( error => {
                console.log( error );
            } );
    </script>
<script>
    $(function () {
        $("#categorias").select2({
            language: "es",
            placeholder: 'Seleccione uno...',
//            maximumSelectionLength: 1,
            allowClear: true
        })

        $("#icatecorias").select2({
            placeholder: 'Seleccione una...',
            language: "es",
            allowClear: true

        });

        $("input[type=text]").focus(function() {
            $(this).select();
        });
    })
</script>
@endpush
