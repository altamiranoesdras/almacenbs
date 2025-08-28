@foreach($opciones ?? App\Models\Option::padres()->get() as $option)
    @php
        $hasChildren = $option->hasChildren();
        $childrenId  = 'children-' . $option->id;
    @endphp

    <li id="{{ $option->id }}">
        <div class="node-row" data-toggle-row="true">
            {{-- Toggle +/- --}}
            @if($hasChildren)
                <span class="toggle" role="button" aria-expanded="true"
                      aria-controls="{{ $childrenId }}"
                      data-bs-toggle="collapse"
                      data-target="#{{ $childrenId }}">
          <span class="plus">+</span><span class="minus">–</span>
        </span>
            @else
                <span class="toggle" style="visibility:hidden;"><span>+</span></span>
            @endif

            {{-- Carpeta (o ícono propio) --}}
            <span class="folder">
        @if($hasChildren)
                    <i class="fa fa-folder-open"></i>
                @else
                    <i class="fa {{ $option->icono_l ?: 'fa-file' }}"></i>
                @endif
      </span>

            {{-- “Mango” para arrastrar (no ocupa si no quieres drag por fila) --}}
            <span class="handle" title="Arrastrar para reordenar">
        <i class="fa fa-grip-vertical"></i>
      </span>

            {{-- Texto principal --}}
            <div class="d-flex align-items-baseline gap-2">
                <span>{{ $option->nombre }}</span>
            </div>

            {{-- Acciones --}}
            <div class="node-actions">
                @include('admin.options.datatables_actions',['id' => $option->id])
            </div>
        </div>

        @if($hasChildren)
            <ul class="tree tree-children collapse show list-unstyled sortable" id="{{ $childrenId }}">
                @include('admin.options.partials.list_admin', ['opciones' => $option->children])
            </ul>
        @endif
    </li>
@endforeach
