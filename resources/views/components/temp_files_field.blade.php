<!-- Files Field -->
<div class="form-group col-sm-12">
    <input id="files" name="files[]" type="file" multiple class="file-loading">
</div>

@push('scripts')
<!--    Scripts temp files field
------------------------------------------------->
<script>
  var $input = $("#files");
    $input.fileinput({
        uploadUrl: "{{route('api.temp_files.multi_store',['user' => $user->id,'opcion' => $opcion])}}", // server upload action
        uploadAsync: false,
        showUpload: false, // hide upload button
        showRemove: false, // hide remove button
        minFileCount: 1,
        maxFileCount: 5,
        allowedFileExtensions: ["png","bmp","gif","jpg","pdf"],
    }).on("filebatchselected", function(event, files) {
        // trigger upload method immediately after files are selected
        $input.fileinput("upload");
    });

</script>
@endpush
