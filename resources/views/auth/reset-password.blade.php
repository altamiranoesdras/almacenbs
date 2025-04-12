@extends('layouts.blank')

@section('titulo_pagina',__('Reset Password'))

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo-->
                        <a class="brand-logo" href="{{route('index')}}">
                            <img src="{{getLogo()}}" class="img-fluid" style="max-height: 24px" alt="logo" srcset=""/>
                            <h2 class="brand-text text-primary ms-1">
                                {{config('app.name')}}
                            </h2>
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                                <img class="img-fluid" src="{{asset('app-assets/images/pages/reset-password-v2-dark.svg')}}" alt="Register V2" />
                            </div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Reset password-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">
                                    {{__("Reset Password")}}
                                    🔒
                                </h2>
                                <p class="card-text mb-2">
                                    {{__("Your new password must be different from previously used passwords")}}
                                </p>

                                @if(session('status'))
                                    <!-- Session Status -->
                                        <div class="alert alert-success" role="alert">
                                            <div class="alert-body">
                                                <strong>{{session('status')}}</strong>
                                            </div>
                                        </div>
                                @endif

                                <!-- Validation Errors -->
                                @include('layouts.partials.request_errors')

                                <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                                {{ __('E-Mail Address') }}
                                            </label>
                                        </div>

                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input id="email"
                                                   type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email"
                                                   value="{{ $request->email ?? old('email') }}" required
                                                   autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="password">
                                                {{__("New Password")}}
                                            </label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">

                                            <input class="form-control form-control-merge" id="password"
                                                   type="password"
                                                   name="password"
                                                   placeholder="············"
                                                   aria-describedby="password"
                                                   autofocus=""
                                                   tabindex="1" />

                                            <span class="input-group-text cursor-pointer">
                                                <i data-feather="eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="password_confirmation">
                                                {{__("Confirm Password")}}
                                            </label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="password_confirmation"
                                                   type="password"
                                                   name="password_confirmation"
                                                   placeholder="············"
                                                   aria-describedby="password_confirmation"
                                                   tabindex="2" />
                                            <span class="input-group-text cursor-pointer">
                                                <i data-feather="eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="3">
                                        {{__("Set New Password")}}
                                    </button>
                                </form>
                                <p class="text-center mt-2">
                                    <a href="{{route('login')}}">
                                        <i data-feather="chevron-left"></i>
                                        {{__("Back to login")}}

                                    </a>
                                </p>
                            </div>
                        </div>
                        <!-- /Reset password-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
