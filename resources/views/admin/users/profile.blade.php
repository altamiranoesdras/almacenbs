@extends('layouts.app')

@section('titulo_pagina', 'Tu perfil')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Tu perfil</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-secondary float-end"
                       href="{{ url()->previous() }}">
                        <i class="fa fa-arrow-left"></i>
                        Regresar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">

        <div class="row">
            <div class="col-12">


                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary ">
                            <div class="card-body ">

                                <div class="text-center p-2">
                                    <img class="profile-user-img img-fluid rounded-circle"
                                         src="{{auth()->user()->img}}"
                                         alt="User profile picture">

                                    <!-- Modal -->

                                    <div class="btn-group icon-edit-avatar">
                                        <button type="button"
                                                class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-camera"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-start">
                                            <button class="dropdown-item" href="#" id="upload_link">
                                                <i class="fa fa-upload"></i>
                                                {{__('Upload your photo')}}
                                            </button>
                                            <button class="dropdown-item " href="#">
                                                <i class="fa fa-times"></i>
                                                {{__('Remove photo')}}
                                            </button>
                                            <input id="upload" type="file" style="display: none"/>
                                        </div>
                                    </div>


                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-edit-avatar" tabindex="-1" role="dialog"
                                         aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel1">
                                                        {{__('Crop your new profile picture')}}
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div class="img-container">
                                                            <img id="imgNewAvatar" src="{{auth()->user()->img}}"
                                                                 alt="Picture" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-success "
                                                            id="set_new_profile_pictur">
                                                        {{__('Set new profile picture')}}
                                                    </button>
                                                    <div class="spinner-border text-success" role="status"
                                                         id="uploadaAvatarSpinner" style="display: none">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Rubrica-->
                                    <div class="modal fade" id="modal-edit-rubrica" tabindex="-1" role="dialog"
                                         aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel1">
                                                        Editar tu Rubrica
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div class="img-container">
                                                            <img id="imgNewRubrica" src="{{auth()->user()->rubrica}}"
                                                                 alt="Picture" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-success "
                                                            id="set_new_rubrica_picture">
                                                        Establecer Rubrica
                                                    </button>
                                                    <div class="spinner-border text-success" role="status"
                                                         id="uploadaRubricaSpinner" style="display: none">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <h3 class="profile-username text-center">
                                    {{Auth::user()->name}}
                                    <br>
                                    <small>{{auth()->user()->unidad->nombre}}</small>
                                </h3>

                                <p class="text-muted text-center">
                                    <a class="text-center" href="{{ route('password.request') }}">
                                        Cambiar contraseña
                                    </a>
                                </p>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active"
                                   id="informacion-general-tab"
                                   data-bs-toggle="tab"
                                   href="#informacion-general"
                                   role="tab"
                                   aria-controls="informacion-general"
                                   aria-selected="true">
                                    <i data-feather="user"></i> Información General
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   id="bitacora-tab"
                                   data-bs-toggle="tab"
                                   href="#bitacora"
                                   role="tab"
                                   aria-controls="bitacora"
                                   aria-selected="false">
                                    <i data-feather="book"></i> Bitácora
                                </a>
                            </li>
                        </ul>
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active"
                                         id="informacion-general"
                                         role="tabpanel"
                                         aria-labelledby="informacion-general-tab">

                                        {!! Form::model($profile, ['route' => ['profile.update', $profile->id], 'method' => 'patch']) !!}
                                        @include('layouts.partials.request_errors')
                                        <div class="card">


                                            <div class="card-body">
                                                <div class="row" id="">
                                                    <div class="col-6 mb-1">
                                                        {!! Form::label('username', __('Username')) !!}
                                                        {!! Form::text('username', null, ['class' => 'form-control' , 'readonly' => auth()->user()->cannot('Editar nombre usuario')]) !!}
                                                    </div>
                                                    <div class="col-6 mb-1">
                                                        {!! Form::label('name', __('Name')) !!}
                                                        {!! Form::text('name', null, ['class' => 'form-control', 'readonly' => auth()->user()->cannot('Editar nombre propio')]) !!}
                                                    </div>
                                                    <div class="col-6 mb-1">
                                                        {!! Form::label('email', __('Email')) !!}
                                                        {!! Form::text('email', null, ['class' => 'form-control', 'readonly' => auth()->user()->cannot('Editar correo electrónico')]) !!}
                                                    </div>

                                                    <div class="col-12 mb-1">
                                                        {!! Form::label('rubrica', __('Rubrica')) !!}

                                                        @if(auth()->user()->rubrica != null)
                                                            <div class="p-1 rounded border">
                                                                <img class="border mx-auto" height="150" width="auto"
                                                                     src="{{auth()->user()->rubrica}}" alt=""
                                                                     id="upload_link_rubrica">
                                                                <input id="upload_rubrica" type="file"
                                                                       style="display: none"
                                                                       accept=".png, .jpg, .jpeg"/>
                                                            </div>
                                                        @else
                                                            <div class="p-1 rounded border">
                                                                <button id="upload_link_rubrica"
                                                                        class="btn btn-primary">
                                                                    Subir Rubrica
                                                                    <i class="fa fa-upload"></i>
                                                                </button>
                                                                <input id="upload_rubrica" type="file"
                                                                       style="display: none"
                                                                       accept=".png, .jpg, .jpeg"/>
                                                            </div>
                                                        @endif

                                                    </div>

                                                </div>

                                            </div><!-- /.card-body -->
                                            <div class="card-footer text-end">

                                                <a href="{{ route('users.index') }}"
                                                   class="btn btn-outline-secondary round me-1">
                                                    <i class="fa fa-ban"></i>
                                                    Cancelar
                                                </a>

                                                <button type="submit" class="btn btn-success round ">
                                                    <i class="fa fa-save"></i>
                                                    Guardar
                                                </button>
                                            </div>


                                        </div>
                                        {!! Form::close() !!}

                                    </div>
                                    <div class="tab-pane fade"
                                         id="bitacora"
                                         role="tabpanel"
                                         aria-labelledby="bitacora-tab">
                                         @include('layouts.partials.bitacoras', ['bitacoras' => Auth::user()->hitorialBitacoras])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

    </div>

@endsection




@push('scripts')
    <script>
        $(function () {

            //para abrir el imput tipo file
            $("#upload_link").on('click', function (e) {
                e.preventDefault();
                $("#upload:hidden").trigger('click');
            });

            //para abrir el imput tipo file
            $("#upload_link_rubrica").on('click', function (e) {
                e.preventDefault();
                $("#upload_rubrica:hidden").trigger('click');

            });


            //después de seleccionar el archivo (carga la imagen en el modal y lo abre)
            $("#upload").change(function () {

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#imgNewAvatar').attr('src', e.target.result);
                        $("#modal-edit-avatar").modal('show');
                    }

                    reader.readAsDataURL(this.files[0]);
                }

            });

            $("#upload_rubrica").change(function () {

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#imgNewRubrica').attr('src', e.target.result);
                        $("#modal-edit-rubrica").modal('show');
                    }

                    reader.readAsDataURL(this.files[0]);
                }

            });

            var cropBoxData;
            var canvasData;
            var cropper;

            //Cuando el modal se abre (inicializa el plugin para recortar la imagen)
            $('#modal-edit-avatar').on('shown.bs.modal', function () {

                var image = document.getElementById('imgNewAvatar');

                cropper = new Cropper(image, {
                    autoCropArea: 1,
                    ready: function () {
                        //Should set crop box data first here
                        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                    }
                });
            }).on('hidden.bs.modal', function () {
                cropBoxData = cropper.getCropBoxData();
                canvasData = cropper.getCanvasData();
                cropper.destroy();
            });

            $('#modal-edit-rubrica').on('shown.bs.modal', function () {

                var image = document.getElementById('imgNewRubrica');

                cropper = new Cropper(image, {
                    autoCropArea: 1,
                    ready: function () {
                        //Should set crop box data first here
                        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                    }
                });
            }).on('hidden.bs.modal', function () {
                cropBoxData = cropper.getCropBoxData();
                canvasData = cropper.getCanvasData();
                cropper.destroy();
            });

            $("#set_new_profile_pictur").click(function (e) {

                e.preventDefault();

                $("#uploadaAvatarSpinner").show();


                cropper.getCroppedCanvas().toBlob(function (blob) {

                    const formData = new FormData();
                    const extension = blob.type.split('/')[1];
                    const imageFile = new File([blob], `${Date.now()}.${extension}`, {
                        type: blob.type,
                    });

                    formData.append('avatar', imageFile);
                    console.log(blob, formData);

                    const header = {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    };

                    const url = '{{route('profile.edit.avatar',auth()->user()->id)}}';

                    axios.post(url, formData, header)
                        .then(response => {
                            log(response);

                            $("#modal-edit-avatar").modal('hide');
                            location.reload();
                        })
                        .catch(error => {
                            log(error.response);
                        });


                });
            })

            $("#set_new_rubrica_picture").click(function (e) {

                e.preventDefault();

                $("#uploadaRubricaSpinner").show();

                cropper.getCroppedCanvas().toBlob(function (blob) {

                    const formData = new FormData();
                    const extension = blob.type.split('/')[1];
                    const imageFile = new File([blob], `${Date.now()}.${extension}`, {
                        type: blob.type,
                    });

                    formData.append('rubrica', imageFile);
                    console.log(blob, formData);

                    const header = {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    };

                    const url = '{{route('profile.edit.rubrica',auth()->user()->id)}}';

                    axios.post(url, formData, header)
                        .then(response => {
                            log(response);

                            $("#modal-edit-rubrica").modal('hide');
                            location.reload();
                        })
                        .catch(error => {
                            log(error.response);
                        });


                });
            })

        });
    </script>
@endpush

@push('estilos')

    <style>
        .icon-edit-avatar {
            position: absolute;
            right: 20px;
            top: 10px;
            text-align: center;
            border-radius: 30px 30px 30px 30px;
            color: white;
            padding: 5px 10px;
            font-size: 20px;
        }
    </style>
@endpush
