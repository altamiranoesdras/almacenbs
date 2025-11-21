<div class="row" id="campos_item">

    <div class="col-sm-12 mb-1">
        <span class="text-danger">(*)</span> Campos obligatorios
    </div>
    <div class="col-sm-5 mb-1">
        <div class="row">
            <!-- Imagen Field -->
            <div class="col-sm-12 mb-1 ">
                {!! Form::label('imagen', 'Imagen:') !!}
                {!! Form::file('imagen', ['class' => 'form-control file']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-7 mb-1">
        <div class="row">

            <!-- Codigo Field -->
            <div class="col-sm-6 mb-1" >
                {!! Form::label('codigo_insumo', 'Código Insumo:') !!}
                {!! Form::text('codigo_insumo', null, ['class' => 'form-control','autofocus']) !!}
            </div>

            <div class="col-sm-6 mb-1" >
                {!! Form::label('codigo_presentacion', 'Código Presentación:') !!}
                {!! Form::text('codigo_presentacion', null, ['class' => 'form-control','autofocus']) !!}
            </div>



            <!-- Nombre Field -->
            <div class="col-sm-12 mb-1" >

                {!! Form::label('nombre', 'Nombre: ') !!}
                <span class="text-danger"> *</span>
                @if((!$item->puedeEditarNombre() ?? false))
                    <span class="text-sm text-warning">
                        <strong>El artículo esta registrado en una compra o requisición</strong>
                    </span>
                @endif
                {!! Form::text('nombre', null, ['class' => 'form-control', ($item->puedeEditarNombre() ?? true) ? '' : 'readonly']) !!}
            </div>

            @if(usuarioAutenticado()->isDev())
                <!-- Stock Field -->
                <div class="col-sm-4 mb-1">
                    {!! Form::label('stock', 'Existencias:') !!}<span class="text-danger"> *</span>
                    {!! Form::number('stock', $item->stocks->sum('cantidad') ?? 0, ['class' => 'form-control',($item->puedeEditarNombre() ?? true) ? '' : 'readonly']) !!}
                </div>

                <!-- Precio Compra Field -->
                <div class="col-sm-4 mb-1">
                    {!! Form::label('precio_compra', 'Precio Compra:') !!}<span class="text-danger"> *</span>
                    {!! Form::number('precio_compra', null, ['class' => 'form-control','step'=>".01"]) !!}
                </div>
            @endif


            {{--            <!-- Precio Venta Field -->--}}
            {{--            <div class="col-sm-4 mb-1">--}}
            {{--                {!! Form::label('precio_venta', 'Precio Venta:') !!}<span class="text-danger"> *</span>--}}
            {{--                {!! Form::number('precio_venta', null, ['class' => 'form-control','step'=>".01"]) !!}--}}
            {{--            </div>--}}


            <div class="col-sm-6 mb-1">
                <select-unimed v-model="unimed" label="Unidad de medida"></select-unimed>
            </div>

            <div class="col-sm-6 mb-1">
                <select-item-presentacion v-model="presentacion" label="Presentación"></select-item-presentacion>
            </div>


            <div class="col-sm-6 mb-1">
                <select-renglon v-model="renglon" label="Renglón"></select-renglon>
            </div>

            <div class="col-sm-6 mb-1">
                <select-item-tipo v-model="tipo" label="Tipo"></select-item-tipo>
            </div>

            <!-- Precio Compra Field -->
            <div class="col-sm-4 mb-1">
                {!! Form::label('stock_minimo', 'Existencia mínima:') !!}
                {!! Form::number('stock_minimo', null, ['class' => 'form-control','step'=>".01"]) !!}
            </div>

            <div class="col-sm-4 mb-1">
                {!! Form::label('stock_maximo', 'Existencia maxima:') !!}
                {!! Form::number('stock_maximo', null, ['class' => 'form-control','step'=>".01"]) !!}
            </div>
        </div>

    </div>



    <div class="col-sm-12 mb-1"  >
        <div class="card border-info">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    Información adicional
                </h5>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="collapse"><i data-feather="chevron-up"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-1">
                            <!-- Descripcion Field -->
                            <div class="col-sm-12 mb-1 col-lg-12">
                                {!! Form::label('descripcion', 'Descripción / Características:') !!}
                                {!! Form::textarea('descripcion', null, ['id' => 'editor','class' => '']) !!}
                            </div>
                        </div>
                        <div class="col-sm-6 mb-1">
                            <div class="row">

                                <!-- Icategoria Id Field -->
                                <div class="col-sm-12 mb-1">
                                    {!! Form::label('icatecoria_id','Categorías: ') !!}
                                    <a class="success" data-bs-toggle="modal" href="#modal-form-icategorias" tabindex="1000">Nueva</a>
                                    {!!
                                        Form::select(
                                            'categorias[]',
                                            select(\App\Models\ItemCategoria::class,'nombre','id',null)
                                            , $categoriasItem ?? null
                                            , ['id'=>'icatecorias','class' => 'form-control ','multiple','style'=>'width: 100%']
                                        )
                                    !!}
                                </div>

                                <!-- Marca Id Field -->
                                <div class="col-sm-6 mb-1">
                                    <select-marca v-model="marca" label="Marca"></select-marca>
                                </div>

                                <!-- Modelo Id Field -->
                                <div class="col-sm-6 mb-1">
                                    <select-item-modelo v-model="modelo" label="Modelo"></select-item-modelo>
                                </div>

                                <!-- Ubicacion Field -->
                                <div class="col-sm-12 mb-1">
                                    {!! Form::label('ubicacion', 'Ubicacion:') !!}
                                    {!! Form::text('ubicacion', null, ['class' => 'form-control']) !!}
                                </div>

{{--                                <div class="col-3 mb-1">--}}
{{--                                    <input type="hidden" name="inventariable" value="0">--}}
{{--                                    <div class="d-flex flex-column">--}}
{{--                                        <label class="form-check-label mb-50" for="inventariable">--}}
{{--                                            Inventariable--}}
{{--                                        </label>--}}
{{--                                        <div class="form-check form-switch form-check-primary">--}}
{{--                                            <input type="checkbox" class="form-check-input" value="1" name="inventariable" id="inventariable" {{ ($item->inventariable ?? false) ? ' checked' : '' }} />--}}
{{--                                            <label class="form-check-label" for="inventariable">--}}
{{--                                                <span class="switch-icon-left"><i data-feather="check"></i></span>--}}
{{--                                                <span class="switch-icon-right"><i data-feather="x"></i></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}



                                <div class="col-3 mb-1">
                                    <input type="hidden" name="perecedero" value="0">
                                    <div class="d-flex flex-column">
                                        <label class="form-check-label mb-50" for="perecedero">
                                            Perecedero
                                        </label>
                                        <div class="form-check form-switch form-check-primary">
                                            <input type="checkbox" class="form-check-input" value="1" name="perecedero" id="perecedero" {{ ($item->perecedero ?? false) ? ' checked' : '' }} />
                                            <label class="form-check-label" for="perecedero">
                                                <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                <span class="switch-icon-right"><i data-feather="x"></i></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>



                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
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

    new Vue({
        el: '#campos_item',
        name: 'campos_item',
        mounted() {
            ClassicEditor
                .create( document.querySelector( '#editor' ), {
                    removePlugins: [ 'Heading', 'Link' ],
                    toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ],
                    minHeight: '800px'
                } )
                .catch( error => {
                    console.log( error );
                } );
            console.log('Instancia vue montada');
            const initialPreview = [];
            const initialPreviewConfig = [];

            @if(isset($item) && $item->img)
            initialPreview.push("{{ asset($item->img) }}");

            initialPreviewConfig.push({
                type: "image",
                filetype: "image/png",
                caption: "Imagen actual",
                key: 1,
                url: false
            });
            @endif

            $("#imagen").fileinput({
                theme: "fa6",
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif"],
                showUpload: false,
                showRemove: true,
                maxFileSize: 5000,
                maxFilesNum: 1,
                previewFileType: "image",
                initialPreviewAsData: true,
                initialPreview: initialPreview,
                initialPreviewConfig: initialPreviewConfig,
                previewSettings: {
                    video: { width: "100%", height: "260px" }
                }
            });
        },
        created() {
            console.log('Instancia vue creada');
        },
        data: {
            renglon : @json($item->renglon ?? \App\Models\Renglon::find(old('renglon_id')) ?? null),
            marca : @json($item->marca ?? \App\Models\Marca::find(old('marca_id')) ?? null),
            modelo : @json($item->modelo ?? \App\Models\ItemModelo::find(old('modelo_id')) ?? null),
            unimed : @json($item->unimed ?? \App\Models\Marca::find(old('unimed_id')) ?? null),
            tipo : @json($item->tipo ?? \App\Models\ItemTipo::find(old('tipo_id')) ?? null),
            presentacion : @json($item->presentacion ?? \App\Models\ItemPresentacion::find(old('presentacion_id')) ?? null)
        },
        methods: {
            getDatos(){
                console.log('Metodo Get Datos');
            }
        }
    });
</script>
@endpush
