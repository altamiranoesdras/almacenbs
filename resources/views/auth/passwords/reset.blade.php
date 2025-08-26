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
                        <!-- Reset Password basic -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="{{route('login')}}" class="brand-logo">
                                    <img src="{{getIcono()}}" alt="logo" class="img-fluid" style="max-height: 8rem">
                                    <h2 class="brand-text text-primary ms-1">
                                        {{config('app.name')}}
                                    </h2>
                                </a>

                                <h4 class="card-title mb-1">Restablecer contraseña 🔒</h4>
                                <p class="card-text mb-2">Su nueva contraseña debe ser diferente a las contraseñas utilizadas anteriormente</p>


                                <form method="POST" action="{{ route('password.update') }}" class="esperar">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    {{-- Email --}}
                                    <div class="mb-1">
                                        <label for="email" class="form-label">
                                            {{ __('Correo electrónico') }}
                                        </label>
                                        <input id="email"
                                               type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               name="email"
                                               value="{{ $email ?? old('email') }}"
                                               required
                                               autocomplete="email"
                                               autofocus>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    {{-- Password --}}
                                    <div class="mb-1">
                                        <label for="password" class="form-label">
                                            {{ __('Contraseña') }}
                                        </label>
                                        <input id="password"
                                               type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"
                                               required
                                               autocomplete="new-password">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    {{-- Confirm Password --}}
                                    <div class="mb-1">
                                        <label for="password-confirm" class="form-label">
                                            {{ __('Confirmar contraseña') }}
                                        </label>
                                        <input id="password-confirm"
                                               type="password"
                                               class="form-control"
                                               name="password_confirmation"
                                               required
                                               autocomplete="new-password">
                                    </div>

                                    {{-- Botón --}}
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary w-100">
                                            {{ __('Establecer nueva contraseña') }}
                                        </button>
                                    </div>
                                </form>


                                <p class="text-center mt-2">
                                    <a href="{{route('login')}}">
                                        <i data-feather="chevron-left"></i>
                                        Volver al inicio de sesión
                                    </a>
                                </p>
                            </div>
                        </div>
                        <!-- /Reset Password basic -->
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
