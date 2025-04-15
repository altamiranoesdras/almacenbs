@can('Ver todas las opciones del menu')
    @foreach($opciones ?? App\Models\Option::padres()->with('children')->get() as $option)

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
        <li class="nav-item {{$option->active()}}">
            <a class="d-flex align-items-center" href="{{rutaOpcion($option)}}">
                <i class="fa {{$option->icono_l}}"></i>
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
