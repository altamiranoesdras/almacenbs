@extends('layouts.blank')

@section('titulo_pagina',__('Login'))

@section('content')
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
                            <img src="{{getLogo()}}" class="img-fluid" style="max-height: 100px" alt="logo" srcset=""/>
                            <h4 class="brand-text text-primary ms-1">
                                {{config('app.name')}}
                            </h4>
                        </a>
                        <!-- /Brand logo-->

                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                                <img class="img-fluid" src="{{getFondoLogin()}}" alt="Login V2"/>
                            </div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">
                                    {{__("Welcome to")}}
                                    {{config('app.name')}}! 👋
                                </h2>
                                <p class="card-text mb-2">
                                    {{__("Please sign-in to your account and start the adventure")}}
                                </p>


                                @include('layouts.partials.request_errors')

                                <form class="auth-login-form mt-2 esperar" action="{{route('login')}}" method="POST">
                                    @csrf

                                    <div class="mb-1">
                                        <label class="form-label" for="login-username">
                                            {{__("Username")  }}
                                            o
                                            {{__("Email")  }}
                                        </label>
                                        <input class="form-control" id="login-username" type="text" name="login" placeholder="john@example.com" aria-describedby="login-email" autofocus="" tabindex="1"/>
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="login-password">
                                                {{__("Password")}}
                                            </label>
                                            <a href="{{route('password.request')}}">
                                                <small>
                                                    {{__("Forgot Password?")}}
                                                </small>
                                            </a>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="login-password"
                                                   type="password"
                                                   name="password"
                                                   placeholder="············"
                                                   aria-describedby="password" tabindex="2"/>
                                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <div class="form-check">
                                            <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3"/>
                                            <label class="form-check-label" for="remember-me">
                                                {{__("Remember Me")}}
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100" tabindex="4" >
                                        {{__("Sign in")}}
                                    </button>
                                </form>
{{--                                <p class="text-center mt-2">--}}
{{--                                    <span>--}}
{{--                                        {{__("New on our platform?")}}--}}
{{--                                    </span>--}}
{{--                                    <a href="{{route('register')}}">--}}
{{--                                        <span>--}}
{{--                                            {{__("Create an account")}}--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </p>--}}

{{--                                @include('auth.partials.botones_redes_login')--}}
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
