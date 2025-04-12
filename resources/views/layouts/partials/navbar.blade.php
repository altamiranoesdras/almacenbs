<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-dark navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
                <li class="nav-item d-none d-lg-block" style="font-size: 1.2rem">
                    <a class="nav-link me-1" href="{{route('home')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Inicio">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block" style="font-size: 1.2rem">
                    <a class="nav-link me-1" href="{{route('home')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email">
                        <i class="fa fa-inbox"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block" style="font-size: 1.2rem">
                    <a class="nav-link me-1" href="{{route('home')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat">
                        <i class="fa fa-message"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block" style="font-size: 1.2rem">
                    <a class="nav-link me-1" href="{{route('home')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Calendar">
                        <i class="fa fa-calendar"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block" style="font-size: 1.2rem">
                    <a class="nav-link me-1" href="{{route('home')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tareas">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li>
            </ul>
        </div>

        <ul class="nav navbar-nav align-items-center ms-auto">

            <!--            Selector de idiomas
            ------------------------------------------------------------------------>
            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-us"></i>
                    <span class="selected-language">English</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                    <a class="dropdown-item" href="#" data-language="en">
                        <i class="flag-icon flag-icon-us"></i> English
                    </a>
                    <a class="dropdown-item" href="#" data-language="es">
                        <i class="flag-icon flag-icon-es"></i> Español
                    </a>
                </div>
            </li>

            <li class="nav-item d-none d-lg-block">
                <a class="nav-link nav-link-style">
                    <i class="ficon" data-feather="sun"></i>
                </a>
            </li>

            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>

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

            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">
                            {{auth()->user()->name}}
                        </span><span class="user-status">
                            {{auth()->user()->maxRol()->name ?? 'Rol'}}
                        </span>
                    </div>
                    <span class="avatar">
                        <img class="round" src="{{auth()->user()->miniatura}}" alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{route('profile')}}">
                        <i class="fa fa-user"></i>
                        {{__('Profile')}}
                    </a>
                    <a class="dropdown-item" href="{{route('profile')}}">
                        <i class="fa fa-inbox"></i>
                        {{__('Inbox')}}
                    </a>
                    <a class="dropdown-item" href="{{route('profile')}}">
                        <i class="fa fa-tasks"></i>
                        {{__('Task')}}
                    </a>
                    <a class="dropdown-item" href="{{route('profile')}}">
                        <i class="fa fa-message"></i>
                        {{__('Chats')}}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('profile')}}">
                        <i class="fa fa-cog"></i>
                        {{__('Settings')}}
                    </a>
                    <a class="dropdown-item" href="{{route('profile')}}">
                        <i class="fa fa-credit-card"></i>
                        {{__('Pricing')}}
                    </a>
{{--                    <a class="dropdown-item" href="{{route('profile')}}">--}}
{{--                        <i class="fa fa-info-circle"></i>--}}
{{--                        {{__('FAQ')}}--}}
{{--                    </a>--}}
                    <a class="dropdown-item" href="{{route('logout')}}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >
                        <i class="fa fa-sign-out"></i>
                        {{__('Logout')}}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

@include('layouts.partials.barra_busqueda')


<!-- END: Header-->
