@extends('layouts.app')

@section('titulo_pagina', 'Notificaciones')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Notificaciones</h2>
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
                <div class="row">
                  <div class="col-sm-6">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">No leídas</h4>
                          <div class="list-group">
                              @foreach(auth()->user()->unreadNotifications as $notificacion)
                                  <a class="list-group-item list-group-item-action" href="{{$notificacion->data['url']}}">
                                      <div class="list-item d-flex align-items-start">
                                          <div class="me-1">
                                              <div class="avatar">
                                                  {{-- <img src="{{$notificacion->data['imagen']}}" alt="avatar" width="32" height="32"> --}}
                                              </div>
                                          </div>
                                          <div class="list-item-body flex-grow-1">
                                              <p class="media-heading">
                                                  <span class="fw-bolder">{{$notificacion->data['titulo'] ?? 'Titulo'}}</span>
                                              </p>
                                              <small class="notification-text">
                                                  {{$notificacion->data['texto'] ?? 'Texto'}}
                                              </small>
                                          </div>
                                      </div>
                                  </a>
                              @endforeach
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="card">
                          <div class="card-body">
                              <h4 class="card-title">leídas</h4>
                              <div class="list-group">
                                  @foreach(auth()->user()->readNotifications as $notificacion)
                                      <a class="list-group-item list-group-item-action" href="{{$notificacion->data['url']}}">
                                          <div class="list-item d-flex align-items-start">
                                              <div class="me-1">
                                                  <div class="avatar">
                                                      {{-- <img src="{{$notificacion->data['imagen']}}" alt="avatar" width="32" height="32"> --}}
                                                  </div>
                                              </div>
                                              <div class="list-item-body flex-grow-1">
                                                  <p class="media-heading">
                                                      <span class="fw-bolder">{{$notificacion->data['titulo'] ?? 'Titulo'}}</span>
                                                  </p>
                                                  <small class="notification-text">
                                                      {{$notificacion->data['texto'] ?? 'Texto'}}
                                                  </small>
                                              </div>
                                          </div>
                                      </a>
                                  @endforeach
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="card">
                    <div class="list-group">

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
