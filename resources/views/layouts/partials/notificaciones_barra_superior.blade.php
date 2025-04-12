<li class="nav-item dropdown dropdown-notification me-25">
    <a class="nav-link" href="#" data-bs-toggle="dropdown">
        <i class="ficon" data-feather="bell"></i>
        @if($cant = auth()->user()->unreadNotifications->count() )
            <span class="badge rounded-pill bg-danger badge-up">
                            {{$cant}}
                        </span>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
        <li class="dropdown-menu-header">
            <div class="dropdown-header d-flex">
                <h4 class="notification-title mb-0 me-auto">{{__('Notifications')}}</h4>
                @if($cant = auth()->user()->unreadNotifications->count() )

                    <div class="badge rounded-pill badge-light-primary">{{$cant}} nuevas</div>
                @endif
            </div>
        </li>
        <li class="scrollable-container media-list">
            @forelse(auth()->user()->unreadNotifications as $notificacion)
                <a class="d-flex" href="{{route('notificaciones.leer',$notificacion->id)}}">
                    <div class="list-item d-flex align-items-start">
                        <div class="me-1">
                            <div class="avatar">
                                <img src="{{$notificacion->data['imagen']}}" alt="avatar" width="32" height="32">
                            </div>
                        </div>
                        <div class="list-item-body flex-grow-1">
                            <p class="media-heading">
                                <span class="fw-bolder">{{$notificacion->data['titulo'] ?? 'Titulo'}}</span>
                            </p>
                            <small class="notification-text">
                                {{$notificacion->data['texto'] ?? 'Texto'}}
                            </small>
                        </div>
                    </div>
                </a>
            @empty
            @endforelse
        </li>
        <li class="dropdown-menu-footer">
            <a class="btn btn-primary w-100" href="{{route('notificaciones.index')}}">
                {{__('Read all notifications')}}
            </a>
        </li>
    </ul>
</li>
