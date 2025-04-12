@extends('errors.layout')

@section('titulo_pagina', __('Page Expired'))

@section('contenido')
    <div class="w-100 text-center">
        <h2 class="mb-1">
            {{__("Page Expired")}}
        </h2>
        <p class="mb-2">
            {{__("Page Expired")}}
        </p>
        <a class="btn btn-primary mb-2 btn-sm-block" href="{{route('home')}}">
            {{__("Back to home")}}
        </a>
        <img class="img-fluid" src="{{asset('app-assets/images/pages/error-dark.svg')}}" alt="Error page"/>
    </div>
@endsection
