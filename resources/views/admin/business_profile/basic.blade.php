


<div class="col-sm-4 mb-1">
    {!! Form::label('nombre_negocio', 'Nombre Empresa:') !!}
    {!! Form::text('name', config('app.name'), ['class' => 'form-control']) !!}
</div>
<div class="col-sm-4 mb-1">
    {!! Form::label('telefono_negocio', 'Teléfono Empresa:') !!}
    {!! Form::text('telefono_negocio', config('app.telefono_negocio'), ['class' => 'form-control']) !!}
</div>
<div class="col-sm-4 mb-1">
    {!! Form::label('whatsapp_negocio', 'Whatsapp Empresa:') !!}
    {!! Form::text('whatsapp_negocio', config('app.whatsapp_negocio'), ['class' => 'form-control']) !!}
</div>
<div class="col-sm-4 mb-1">
    {!! Form::label('direccion_negocio', 'Dirección Empresa:') !!}
    {!! Form::text('direccion_negocio', config('app.direccion_negocio'), ['class' => 'form-control']) !!}
</div>
<div class="col-sm-4 mb-1">
    {!! Form::label('correo_negocio', 'Correo Empresa:') !!}
    {!! Form::text('correo_negocio', config('app.correo_negocio'), ['class' => 'form-control']) !!}
</div>

<div class="col-sm-4 mb-1">
    {!! Form::label('horario_negocio', 'Horario:') !!}
    {!! Form::text('horario_negocio', config('app.horario_negocio'), ['class' => 'form-control','placeholder' => '9:00am - 6:00pm']) !!}
</div>


<div class="col-sm-6 mb-1">
    {!! Form::label('name', 'Logo:') !!}
    <input type="file" name="logo" class="form-control" id="logo">
</div>

<div class="col-sm-6 mb-1">
    {!! Form::label('name', 'Fondo Login:') !!}
    <input type="file" name="fondo_login" class="form-control" id="fondo_login">
</div>



<div class="col-sm-6 mb-2">
    {!! Form::label('name', 'Icono:') !!}
    <span class="text-muted">
        Se utliza en diferntes lugares como: favicon, pwa, preload
    </span>
    <input type="file" name="icono" class="form-control" id="icono">
</div>



<div class="col-sm-12 mb-1 " >
    {!! Form::label('name', 'Texto Correo:') !!}
    <div id="snow-container">
        <div class="quill-toolbar">
        <span class="ql-formats">
            <select class="ql-header">
                <option value="1">Titulo</option>
                <option value="2">Subtitulo</option>
                <option selected>Normal</option>
            </select>
        </span>
            <span class="ql-formats">
            <button class="ql-bold"></button>
            <button class="ql-italic"></button>
            <button class="ql-underline"></button>
        </span>
            <span class="ql-formats">
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
        </span>
            <span class="ql-formats">
            <button class="ql-link"></button>
            <button class="ql-image"></button>
            <button class="ql-video"></button>
        </span>
            <span class="ql-formats">
            <button class="ql-formula"></button>
            <button class="ql-code-block"></button>
        </span>
            <span class="ql-formats">
            <button class="ql-clean"></button>
        </span>
        </div>
        <div class="editor" style="min-height: 10rem">
            {!! config('app.texto_correo') !!}
        </div>
    </div>

    <input type="hidden" name="texto_correo" class="editor_data" value="">
</div>


<input type="hidden" name="clear_logo" id="clear_logo" value="0">
<input type="hidden" name="clear_icono" id="clear_icono" value="0">
<input type="hidden" name="clear_fondo_login" id="clear_fondo_login" value="0">
<input type="hidden" name="clear_promo_factura" id="clear_promo_factura" value="0">

@push('scripts')
    <script>
        $(function () {



            $("#logo").fileinput({
                language: "es",
                initialPreview: @json(getLogo()),
                dropZoneEnabled: true,
                maxFileCount: 1,
                maxFileSize: 2000,
                showUpload: false,
                initialPreviewAsData: true,
                showBrowse: true,
                showRemove: true,
                theme: "fa6",
                browseOnZoneClick: true,
                allowedPreviewTypes: ["image"],
                allowedFileTypes: ["image"],
                initialPreviewFileType: 'image',
            }).on('filecleared', function(event) {
                $("#clear_logo").val(1);
            });


            $("#icono").fileinput({
                language: "es",
                initialPreview: @json(getIcono()),
                dropZoneEnabled: true,
                maxFileCount: 1,
                maxFileSize: 2000,
                showUpload: false,
                initialPreviewAsData: true,
                showBrowse: true,
                showRemove: true,
                theme: "fa6",
                browseOnZoneClick: true,
                allowedPreviewTypes: ["image"],
                allowedFileTypes: ["image"],
                initialPreviewFileType: 'image',
            }).on('filecleared', function(event) {
                $("#clear_icono").val(1);
            });



            $("#fondo_login").fileinput({
                language: "es",
                initialPreview: @json(getFondoLogin()),
                dropZoneEnabled: true,
                maxFileCount: 1,
                maxFileSize: 2000,
                showUpload: false,
                initialPreviewAsData: true,
                showBrowse: true,
                showRemove: true,
                theme: "fa6",
                browseOnZoneClick: true,
                allowedPreviewTypes: ["image"],
                allowedFileTypes: ["image"],
                initialPreviewFileType: 'image',
            }).on('filecleared', function(event) {
                $("#clear_fondo_login").val(1);
            });

        })
    </script>
@endpush
