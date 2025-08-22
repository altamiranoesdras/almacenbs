@extends('layouts.blank')

@section('title', 'Página en construcción')

@section('page-style')
    <style>
        .uc-wrap {
            min-height: calc(100vh - 7rem);
            display: grid;
            place-items: center;
        }

        .uc-card {
            max-width: 720px;
            width: 100%;
            border-radius: 0.75rem;
        }

        .uc-title {
            font-weight: 600;
            letter-spacing: .2px;
        }

        .uc-text {
            color: #6e6b7b;
        }

        .dark-layout .uc-text {
            color: #c9c9d3;
        }
    </style>
@endsection

@section('content')
    <div class="content-body mt-5">
        <div class="container-fluid">
            <div class="container-xxl uc-wrap">
                <div class="card uc-card shadow-sm">
                    <div class="card-body p-4 p-md-5 text-center">
                        <h1 class="uc-title mb-1">Página en construcción</h1>

                        <p class="uc-text mb-3">
                            Estamos trabajando para habilitar este contenido. Agradecemos su comprensión.
                        </p>

                        {{-- Información opcional: fecha estimada y referencia a ticket/notas --}}
                        @isset($eta)
                            <p class="text-muted mb-2">Disponibilidad estimada: <strong>{{ $eta }}</strong></p>
                        @endisset

                        @isset($referenceUrl)
                            <p class="mb-3">
                                <a href="{{ $referenceUrl }}" class="link-primary" target="_blank" rel="noopener">
                                    Ver notas de actualización
                                </a>
                            </p>
                        @endisset

                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="{{ url('/') }}" class="btn btn-primary">
                                <i data-feather="home" class="me-50"></i> Inicio
                            </a>
                        </div>

                        <div class="mt-3">
                            <small class="text-muted">Última actualización: {{ now()->format('d/m/Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        if (window.feather) window.feather.replace();
    </script>
@endsection
