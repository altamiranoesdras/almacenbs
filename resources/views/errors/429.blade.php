@extends('errors.layout')

@section('titulo_pagina', __('Too Many Requests'))

@section('contenido')
    <div class="w-100 text-center">
        <h2 class="mb-1">
            {{__("Too Many Requests")}}
            🕵🏻‍♀️
        </h2>
        <p class="mb-2">
            {{__("Too Many Requests")}}
        </p>
        <a class="btn btn-primary mb-2 btn-sm-block" href="{{route('home')}}">
            {{__("Back to home")}}
        </a>
        <img class="img-fluid" src="{{asset('app-assets/images/pages/error-dark.svg')}}" alt="Error page"/>
    </div>
@endsection
