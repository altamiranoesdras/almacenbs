@extends('layouts.blank')

@section('titulo_pagina',__('Register'))

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
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="../../../app-assets/images/pages/register-v2-dark.svg" alt="Register V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Register-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">
                                    {{__("Adventure starts here")}}
                                    🚀
                                </h2>
                                <p class="card-text mb-2">
                                    {{__("Make your app management easy and fun!")}}
                                </p>

                                <!-- Validation Errors -->
                                @include('layouts.partials.request_errors')

                                <form class="auth-register-form mt-2" action="{{route('register')}}" method="POST">
                                    @csrf
                                    <div class="mb-1">
                                        <label class="form-label" for="username">
                                            {{__("Username")}}
                                        </label>
                                        <input class="form-control" id="username" type="text" name="username" placeholder="johndoe" aria-describedby="username" autofocus="" tabindex="1" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="email">
                                            {{__("Email")}}
                                        </label>
                                        <input class="form-control" id="email" type="text" name="email" placeholder="john@example.com" aria-describedby="email" tabindex="2" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="password">
                                            {{__("Password")}}
                                        </label>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" aria-describedby="password" tabindex="3" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <div class="form-check">
                                            <input class="form-check-input" id="register-privacy-policy" type="checkbox" tabindex="4" />
                                            <label class="form-check-label" for="register-privacy-policy">
                                                {{__("I agree to")}}
                                                <a href="#">&nbsp;privacy policy & terms</a>
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="5">
                                        {{__("Sign up")}}
                                    </button>
                                </form>
                                <p class="text-center mt-2">
                                    <span>
                                        {{__("Already have an account?")}}
                                    </span>
                                    <a href="{{route('login')}}">
                                        <span>&nbsp;
                                            {{__("Sign in instead")}}
                                        </span>
                                    </a>
                                </p>


                            </div>
                        </div>
                        <!-- /Register-->
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
