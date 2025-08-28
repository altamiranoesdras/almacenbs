@extends('layouts.blank')

@section('titulo_pagina',__('Reset Password'))

@section('content')


    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <!-- Forgot Password basic -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="{{route('login')}}" class="brand-logo">
                                    <img src="{{getIcono()}}" alt="logo" class="img-fluid" style="max-height: 8rem">
                                    <h2 class="brand-text text-primary ms-1">
                                        {{config('app.name')}}
                                    </h2>
                                </a>

                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <div class="alert-body">
                                            {{ session('status') }}
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <h4 class="card-title mb-1">¿Has olvidado tu contraseña? 🔒</h4>
                                <p class="card-text mb-2">Ingresa tu correo electrónico y te enviaremos instrucciones para restablecer tu contraseña</p>

                                <form method="POST" action="{{ route('password.email') }}" class="esperar">
                                    @csrf


                                    <div class="mb-1">
                                        <label for="forgot-password-email" class="form-label">
                                            Correo electrónico
                                        </label>
                                        <div class="col">
                                            <input id="email"
                                                   type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email"
                                                   value="{{ old('email') }}"
                                                   required
                                                   placeholder="john@example.com"
                                                   aria-describedby="forgot-password-email"
                                                   tabindex="1"
                                                   autofocus >

                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button class="btn btn-primary w-100" tabindex="2" >
                                        Enviar enlace de restablecimiento
                                    </button>
                                </form>

                                <p class="text-center mt-2">
                                    <a href="{{route('login')}}">
                                        <i data-feather="chevron-left"></i>
                                        Volver al inicio de sesión
                                    </a>
                                </p>
                            </div>
                        </div>
                        <!-- /Forgot Password basic -->
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

