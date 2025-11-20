<!-- Titulo Field -->
<div class="col-sm-6 mb-1">
    {!! Form::label('titulo', 'Titulo:') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control', 'required',  'maxlength' => 255]) !!}
</div>


<!-- Descripcion Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'maxlength' => 65535,'rows' => 2]) !!}
</div>


<!-- Video Field -->
<div class="col-sm-12 mb-1 col-lg-12">
    {!! Form::label('video', 'Video:') !!}
    {!! Form::file('video', ['class' => 'form-control', 'id' => 'video']) !!}
    <div class="form-text">Formato: mp4, avi, mov, wmv, mkv, flv, webm</div>
</div>


@push('scripts')
    <script>
        $(function() {

            const initialPreview = [];
            const initialPreviewConfig = [];

            @if(isset($ayudaVideo) && $ayudaVideo->video)
            initialPreview.push("{{ asset($ayudaVideo->video) }}");

            initialPreviewConfig.push({
                type: "video",
                filetype: "video/mp4",
                caption: "Video actual",
                key: 1,
                url: false
            });
            @endif

            $("#video").fileinput({
                theme: "fa6",
                allowedFileExtensions: ["mp4", "avi", "mov", "wmv", "mkv", "flv", "webm"],
                showUpload: false,
                showRemove: true,
                maxFileSize: 50000,
                maxFilesNum: 1,
                previewFileType: "video",
                initialPreviewAsData: true,
                initialPreview: initialPreview,
                initialPreviewConfig: initialPreviewConfig,
                previewSettings: {
                    video: { width: "100%", height: "260px" }
                }
            });
        });
    </script>
@endpush


