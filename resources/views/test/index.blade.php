@extends('layouts.app')

@section('titulo_pagina', 'Test')

@section('content')

{{-- @livewire('test.test') --}}

    <form method="POST" action="{{ route('firmar.documento') }}" enctype="multipart/form-data" class="form-horizontal">
        {{-- CSRF token for form submission --}}
        @csrf
        <div>
            <label for="documento">Documento a Firmar:</label>
            <input class="form-control" type="file" name="documento" id="documento" required accept=".pdf">
        </div>

        <div>
            <label for="rubrica">Rúbrica:</label>

            @if(auth()->user()->rubrica)
                <div class="p-1 rounded border">
                    <img class="border mx-auto" height="150" width="auto"  src="{{auth()->user()->rubrica}}" alt="" id="upload_link_rubrica">
                </div>
                <input type="hidden" name="rubrica_user" id="rubrica" value="{{auth()->user()->rubrica}}">
            @else
                <input class="form-control" type="file" name="rubrica" id="rubrica" required accept=".png,.jpg,.jpeg">
            @endif

        </div>

        <div class="pb-3 form-group" >

            <label for="firma_inicio_x">Inicio Horizontal en mm:</label>
            <input class="form-control" type="number" name="firma_inicio_x" id="firma_inicio_x" required placeholder="Inicio Horizontal en mm" value="250">
            <label for="firma_inicio_y">Inicio Vertical en mm:</label>
            <input class="form-control" type="number" name="firma_inicio_y" id="firma_inicio_y" required placeholder="Inicio vertical en mm" value="0">
            <label for="firma_ancho">Ancho en mm:</label>
            <input class="form-control" type="number" name="firma_ancho" id="firma_ancho" required placeholder="Ancho en mm" value="300">
            <label for="firma_alto">Alto en mm:</label>
            <input class="form-control" type="number" name="firma_alto" id="firma_alto" required placeholder="Alto en mm" value="75">

        </div>

        <div>
            <label for="lugar">Lugar:</label>
            <input class="form-control" type="text" name="lugar" id="lugar" value="Guatemala, Guatemala" required>
        </div>

        <div>
            <label for="tipo_solicitud">Tipo de Solicitud:</label>
            <select class="form-control" name="tipo_solicitud" id="tipo_solicitud">
                <option value="PDF">PDF</option>
                <option value="XML">XML</option>
            </select>
        </div>

       
        {{-- concepto --}}
        <div>
            <label for="concepto">Concepto:</label>
            <input class="form-control" type="text" name="concepto" id="concepto" value="test" required>
        </div>

        <div>
            <button type="submit" class="btn btn-primary">Firmar Documento</button>
        </div>

    </form>

@endsection