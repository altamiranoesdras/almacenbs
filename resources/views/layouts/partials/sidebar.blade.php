<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">

    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{route('index')}}">
                    <span class="brand-logo">
                            <img src="{{getLogo()}}" alt="Logo">
                    </span>
                    <h2 class="brand-text">
{{--                        {{ iniciales(config('app.name')) }}--}}
                        SBS
                    </h2>
                </a></li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            @include('layouts.partials.menu')

            <div class="my-5 py-5">
                <br>
            </div>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
