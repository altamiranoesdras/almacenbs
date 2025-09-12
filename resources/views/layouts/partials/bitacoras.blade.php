<ul class="timeline">

    @forelse($bitacoras->sortByDesc('created_at') as $bitacora)
        <li class="timeline-item">
            <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
            <div class="timeline-event">

                {{-- Título y hora --}}
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                    <h6 class="mb-50">{{ $bitacora->titulo }}</h6>
                    <span class="timeline-event-time">{{ fechaHoraLtn($bitacora->created_at) }}</span>
                </div>

                {{-- Comentario --}}
                @if($bitacora->comentario)
                    <p>{{ $bitacora->comentario ?? 'sin comentario' }}</p>
                @endif


                {{-- Usuario --}}
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                    <div class="d-flex flex-row align-items-center">
                        <div class="avatar me-1">
                            <img src="{{ $bitacora->usuario->img ?? asset('images/default-avatar.png') }}"
                                 alt="Avatar"
                                 height="32" width="32" class="rounded-circle" />
                        </div>
                        <span>
                            <p class="mb-0">{{ $bitacora->usuario->name ?? 'SISTEMA' }}</p>
                            <span class="text-muted">{{ $bitacora->usuario->puesto->nombre ?? '' }}</span>
                        </span>
                    </div>

                    {{-- Acciones (solo visuales) --}}
{{--                    <div class="d-flex align-items-center cursor-pointer mt-sm-0 mt-50">--}}
{{--                        <i data-feather="message-square" class="me-1"></i>--}}
{{--                        <i data-feather="phone-call"></i>--}}
{{--                    </div>--}}
                </div>

            </div>
        </li>
    @empty
        <li class="timeline-item">
            <span class="timeline-point timeline-point-secondary timeline-point-indicator"></span>
            <div class="timeline-event">
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                    <h6 class="mb-50">No hay registros en la bitácora</h6>
                </div>
            </div>
        </li>
    @endforelse

</ul>
