@push('estilos')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/editors/quill/katex.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/editors/quill/monokai-sublime.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/editors/quill/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/editors/quill/quill.bubble.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/form-quill-editor.css')}}">
@endpush
@push('scripts')
    <script src="{{asset('app-assets/vendors/js/editors/quill/katex.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/editors/quill/highlight.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/editors/quill/quill.min.js')}}"></script>

    <script>
        $(function (){
            var Font = Quill.import('formats/font');
            Font.whitelist = ['arial','sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
            Quill.register(Font, true);

            var Editor = new Quill('.editor', {
                bounds: '.editor',
                modules: {
                    formula: true,
                    syntax: true,
                    toolbar: '.quill-toolbar'
                },
                theme: 'snow'
            });

            Editor.on('editor-change',function (delta, oldDelta, source){

                let contenido = $(".ql-editor").html();
                // console.log('texto editado',contenido)

                $(".editor_data").val(contenido)
            })
        })
    </script>
@endpush
