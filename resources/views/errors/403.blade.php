@extends('errors.layout')

@section('titulo_pagina', __('Forbidden'))

@section('contenido')
    <div class="w-100 text-center">
        <h2 class="mb-1">
            {{__("You are not authorized!")}}
            🔐
        </h2>
        <p class="mb-2">
            {{__("You are not authorized!")}}
        </p>
        <a class="btn btn-primary mb-1 btn-sm-block" href="{{route('home')}}">
            {{__('Back to home')}}
        </a>
        <img class="img-fluid" src="{{asset('app-assets/images/pages/not-authorized-dark.svg')}}" alt="Not authorized page" />
    </div>
@endsection
