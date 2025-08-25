@foreach($unidades ?? App\Models\RrhhUnidad::padres()->get() as $unidad)
    @php
        $hasChildren = $unidad->hasChildren();
        $childrenId  = 'children-' . $unidad->id;
    @endphp

    <li id="{{ $unidad->id }}">
        <div class="node-row" data-toggle-row="true">
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

            <span class="folder">
        <i class="fa {{ $hasChildren ? 'fa-folder-open' : 'fa-folder' }}"></i>
      </span>

            <div class="d-flex align-items-baseline gap-2">
                <span class="unidad-codigo">{{ $unidad->codigo }}</span>
                <span>{{ $unidad->nombre }}</span>
                <span class="unidad-tipo">({{ $unidad->tipo->nombre }})</span>
            </div>

            <div class="node-actions">
                @include('rrhh_unidads.datatables_actions', ['id' => $unidad->id])
            </div>
        </div>

        @if($hasChildren)
            <ul class="tree tree-children collapse show list-unstyled" id="{{ $childrenId }}">
                @include('rrhh_unidads.partials.listado_unidades', ['unidades' => $unidad->children])
            </ul>
        @endif
    </li>
@endforeach
