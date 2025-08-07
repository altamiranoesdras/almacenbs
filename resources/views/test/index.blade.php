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
            <input class="form-control" type="file" name="rubrica" id="rubrica" required accept=".png,.jpg,.jpeg">
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