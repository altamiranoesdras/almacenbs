@extends('layouts.app')

@section('titulo_pagina', 'Configuraciones')

@include('layouts.plugins.bootstrap_fileinput')
@include('layouts.plugins.select2')
@include('layouts.plugins.quill-editor')


@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Configuraciones</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-secondary float-right"
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
                <div class="card">
                    <div class="col-lg-12">

                            <div class="card">
                                <form action="{{route('profile.business.store')}}" method="post" class="esperar" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <ul class="nav nav-tabs ">
                                            <li class="nav-item  ">
                                                <a class="nav-link active" data-bs-toggle="pill" href="#basico" aria-expanded="true">Basicas</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link"  data-bs-toggle="pill" href="#correo" aria-expanded="false">
                                                    Buzón Salida Correo
                                                </a>
                                            </li>
{{--                                            <li class="nav-item ">--}}
{{--                                                <a class="nav-link"  data-bs-toggle="pill" href="#seo" aria-expanded="false">--}}
{{--                                                    SEO--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="basico" aria-labelledby="pestana_basico" aria-expanded="true">
                                                <div class="row">
                                                    @include('admin.business_profile.basic')
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="correo" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                                                @include('admin.business_profile.correo')
                                            </div>

{{--                                            <div class="tab-pane" id="seo" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">--}}
{{--                                                @include('admin.business_profile.seo')--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>

                                    <div class="card-footer text-end">
                                        <a href="{!! route('profile.business') !!}" class="btn btn-outline-secondary round me-1">
                                            <i class="fa fa-ban"></i>
                                            Cancelar
                                        </a>
                                        <button type="submit"  class="btn btn-success round">
                                            <i class="fa fa-save"></i>
                                            Guardar
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection





