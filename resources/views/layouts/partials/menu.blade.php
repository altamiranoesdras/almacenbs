@can('Ver todas las opciones del menu')
    @foreach($opciones ?? App\Models\Option::padres()->with('children')->get() as $option)


        @if($option->id==7)
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">
                    ALMACÉN
                </span><i data-feather="more-horizontal"></i>
            </li>
        @endif

        <li class="nav-item {{$option->active()}}">
            <a class="d-flex align-items-center" href="{{rutaOpcion($option)}}">
                <i class="fa {{$option->icono_l}} text-{{$option->color}}"></i>
                <span class="menu-title text-truncate" data-i18n="Menu Levels">
                    {{$option->nombre}}
                    </span>
            </a>
            @if($option->hasChildren())
                <ul class="menu-content">
                    @include('layouts.partials.menu',['opciones' => $option->children])
                </ul>
            @endif
        </li>
    @endforeach
@else
    @foreach($opciones ?? optionsParentAuthUser() as $option)

        @if($option->id==7)
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">
                    ALMACÉN
                </span><i data-feather="more-horizontal"></i>
            </li>
        @endif

        <li class="nav-item {{$option->active()}}">
            <a class="d-flex align-items-center" href="{{rutaOpcion($option)}}">
                <i class="fa {{$option->icono_l}} text-{{$option->color}}"></i>
                <span class="menu-title text-truncate" data-i18n="Menu Levels">
                    {{$option->nombre}}
                    </span>
            </a>
            @if($option->hasChildren())
                <ul class="menu-content">
                    @include('layouts.partials.menu',['opciones' => $option->children])
                </ul>
            @endif
        </li>
    @endforeach
@endcan
