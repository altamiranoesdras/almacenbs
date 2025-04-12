@extends('layouts.blank')

@section('titulo_pagina',__('Forgot Password?'))

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
                                <img class="img-fluid"
                                     src="{{asset('app-assets/images/pages/forgot-password-v2-dark.svg')}}"
                                     alt="Forgot password " />
                            </div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Forgot password-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">
                                    {{__("Forgot Password?")}}
                                    🔒
                                </h2>
                                <p class="card-text mb-2">
                                    {{__("Enter your email and we'll send you instructions to reset your password")}}
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

                                <form class="auth-forgot-password-form mt-2" action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <div class="mb-1">
                                        <label class="form-label" for="email">
                                            {{__("Email")}}
                                        </label>
                                        <input class="form-control"
                                               type="text"
                                               name="email"
                                               placeholder="john@example.com"
                                               aria-describedby="email"
                                               autofocus=""
                                               tabindex="1"
                                               value="{{old('email')}}"
                                        />
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="2">
                                        {{__("Send reset link")}}
                                    </button>
                                </form>
                                <p class="text-center mt-2">
                                    <a href="{{route('login')}}" class="text-capitalize">
                                        <i data-feather="chevron-left"></i>
                                        {{__("cancel")}}
                                    </a>
                                </p>
                            </div>
                        </div>
                        <!-- /Forgot password-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
