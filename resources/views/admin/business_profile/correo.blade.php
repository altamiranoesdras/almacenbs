<div class="col-sm-12 mb-1">
    <div class="card shadow-none bg-transparent border-info">
        <div class="card-header border-bottom py-1">
            <div class="col">
                Credenciales
                @if($faltanCrednciales = \App\Models\Configuration::faltanCredencialesCorreoSalida())
                    <i class="fa fa-exclamation-triangle text-danger"></i>
                @endif
            </div>
            <div class="col">

            </div>
        </div>
        <div class="card-body ">

            <div class="row mt-2">

                <div class="col-sm-4 mb-1">
                    {!! Form::label('app.host_correo_salida', 'Host:') !!}
                    {!! Form::text('app.host_correo_salida', config('app.host_correo_salida'), ['class' => 'form-control','placeholder' => 'mail.proveedor.com']) !!}
                </div>
                <div class="col-sm-4 mb-1">
                    {!! Form::label('app.puerto_correo_salida', 'Puerto de salida:') !!}
                    {!! Form::text('app.puerto_correo_salida', config('app.puerto_correo_salida'), ['class' => 'form-control','placeholder' => '465']) !!}
                </div>
                <div class="col-sm-4 mb-1">
                    {!! Form::label('app.usuario_correo_salida', 'Usuario :') !!}
                    {!! Form::text('app.usuario_correo_salida', config('app.usuario_correo_salida'), ['class' => 'form-control','placeholder' => 'ejemplo@dominio.com']) !!}
                </div>
                <div class="col-sm-4 mb-1">
                    {!! Form::label('app.password_correo_salida', 'Contraseña:') !!}

                    <div class="input-group input-group-merge form-password-toggle">
                        <input class="form-control form-control-merge" id="login-password"
                               type="password"
                               name="app.password_correo_salida"
                               value="{{ config('app.password_correo_salida') ?? '' }}"
                               placeholder="············"
                               aria-describedby="password" tabindex="2"/>
                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i>
                                            </span>
                    </div>

                </div>
                <div class="col-sm-4 mb-1">
                    {!! Form::label('app.encryption_correo_salida', 'Encriptación:') !!}
                    {!! Form::text('app.encryption_correo_salida', config('app.encryption_correo_salida'), ['class' => 'form-control','placeholder' => 'ssl']) !!}
                </div>
                {{--                <div class="col-sm-4 mb-1">--}}
                {{--                    {!! Form::label('app.from_address_correo_salida', 'Correo correo salida:') !!}--}}
                {{--                    {!! Form::text('app.from_address_correo_salida', config('app.from_address_correo_salida'), ['class' => 'form-control','placeholder' => "Normalmente el mismo que el usuario"]) !!}--}}
                {{--                </div>--}}
                {{--                <div class="col-sm-4 mb-1">--}}
                {{--                    {!! Form::label('app.from_name_correo_salida', 'NOMBRE:') !!}--}}
                {{--                    {!! Form::text('app.from_name_correo_salida', config('app.from_name_correo_salida'), ['class' => 'form-control','placeholder' => config('app.name')]) !!}--}}
                {{--                </div>--}}

                @if(!$faltanCrednciales)

                    <!--boton para enviar correo de prueba-->
                    <div class="col-sm-4 mb-1">

                        <br>
                        <!-- Button trigger modal -->
                        <a href="#" type="button" id="btn_enviar_correo_prueba" class=""
                           data-bs-toggle="modal"
                           data-bs-target="#enviar_correo_prueba"

                        >
                            Enviar correo de prueba
                        </a>

                        @section('modals')
                            <!-- Modal -->
                            <div class="modal fade" id="enviar_correo_prueba" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Enviar correo de prueba
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('dev.configurations.prueba.correo')}}" method="post" class="esperar">

                                            <div class="modal-body">
                                                <!--Campo para ingresar el correo al que se enviara el correo de prueba-->
                                                @csrf

                                                <div class="row">
                                                    <div class="col-sm-12 mb-1">
                                                        {!! Form::label('Correo', 'Correo:') !!}
                                                        {!! Form::text('correo', null, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary" onclick="esperar()">
                                                    Enviar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endsection
                    </div>
                @endif
            </div>

        </div>
    </div>
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

    <input type="hidden" name="app.texto_correo" class="editor_data" value="">
</div>

<div class="col-sm-12 mb-1 " >
    <label for="vista_previa_correo">Vista Previa</label>
    <div class="ratio ratio-16x9">
        <iframe id="vista_previa_correo" src="{{route('dev.pruebas.correo.vista.previa')}}"  allowfullscreen></iframe>
    </div>
</div>
