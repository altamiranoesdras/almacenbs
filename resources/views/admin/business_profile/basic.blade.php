


<div class="col-sm-4 mb-1">
    {!! Form::label('app.nombre_negocio', 'Nombre Empresa:') !!}
    {!! Form::text('app.name', config('app.name'), ['class' => 'form-control']) !!}
</div>
<div class="col-sm-4 mb-1">
    {!! Form::label('app.telefono_negocio', 'Teléfono Empresa:') !!}
    {!! Form::text('app.telefono_negocio', config('app.telefono_negocio'), ['class' => 'form-control']) !!}
</div>
<div class="col-sm-4 mb-1">
    {!! Form::label('app.whatsapp_negocio', 'Whatsapp Empresa:') !!}
    {!! Form::text('app.whatsapp_negocio', config('app.whatsapp_negocio'), ['class' => 'form-control']) !!}
</div>
<div class="col-sm-4 mb-1">
    {!! Form::label('app.direccion_negocio', 'Dirección Empresa:') !!}
    {!! Form::text('app.direccion_negocio', config('app.direccion_negocio'), ['class' => 'form-control']) !!}
</div>
<div class="col-sm-4 mb-1">
    {!! Form::label('app.correo_negocio', 'Correo Empresa:') !!}
    {!! Form::text('app.correo_negocio', config('app.correo_negocio'), ['class' => 'form-control']) !!}
</div>

<div class="col-sm-4 mb-1">
    {!! Form::label('app.horario_negocio', 'Horario:') !!}
    {!! Form::text('app.horario_negocio', config('app.horario_negocio'), ['class' => 'form-control','placeholder' => '9:00am - 6:00pm']) !!}
</div>

<div class="col-sm-4 mb-1">
    {!! Form::label('app.monto_maximo_facturar', 'Monto Maximo Facturar:') !!}
    {!! Form::text('app.monto_maximo_facturar', config('app.monto_maximo_facturar'), ['class' => 'form-control','placeholder' => '']) !!}
</div>

<div class="col-sm-12" style="padding: 0px; margin: 0px"></div>
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


<input type="hidden" name="clear_logo" id="clear_logo" value="0">
<input type="hidden" name="clear_icono" id="clear_icono" value="0">
<input type="hidden" name="clear_fondo_login" id="clear_fondo_login" value="0">

<div class="col-sm-12 mb-1">
    <div class="card shadow-none bg-transparent border-success">
      <div class="card-header border-bottom py-1 text-success">
        API Whatsapp
      </div>
      <div class="card-body ">

          <div class="row mt-2">

              <div class="col-sm-4 mb-1">
                  {!! Form::label('api_cloud_whatsapp.access_token', 'Access Token:') !!}
                  {!! Form::text('api_cloud_whatsapp.access_token', config('api_cloud_whatsapp.access_token'), ['class' => 'form-control','placeholder' => '']) !!}
              </div>
              <div class="col-sm-4 mb-1">

                  {!! Form::label('api_cloud_whatsapp.from_phone_number_id', 'From Phone Number Id:') !!}
                  {!! Form::text('api_cloud_whatsapp.from_phone_number_id', config('api_cloud_whatsapp.from_phone_number_id'), ['class' => 'form-control','placeholder' => '']) !!}
              </div>
          </div>

      </div>
    </div>
</div>
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
