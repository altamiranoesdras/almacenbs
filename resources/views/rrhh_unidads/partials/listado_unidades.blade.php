@foreach($unidades ?? App\Models\RrhhUnidad::padres()->get() as $unidad)
    <li  id="{{$unidad->id}}" class="list-group-item  border-top-0 border-bottom-0 border-right-0 py-0 pt-1 {{$unidad->isChildren() ? ' ps-3' : ' border-left-0'}}">

{{--            <i class="fa fa-building-columns handle mr-2" style="cursor: move"></i>--}}

            <b>{{$unidad->codigo}}</b>
            {{$unidad->nombre}} ({{$unidad->tipo->nombre}})

            @include('rrhh_unidads.datatables_actions',['id' => $unidad->id])

        @if($unidad->hasChildren())
            <ul class="list-group sortable">
                @include('rrhh_unidads.partials.listado_unidades', ['unidades' => $unidad->children])
            </ul>
        @endif
    </li>
@endforeach
