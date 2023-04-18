



@php
    $bitacoras = $bitacoras->groupBy('seccion');
@endphp

<div class="timeline" >

    @foreach($bitacoras as $seccion => $elementos)

{{--        <!-- timeline time label -->--}}
{{--        <div class="time-label">--}}
{{--            <span class="bg-red">{{$seccion}}</span>--}}
{{--        </div>--}}
{{--        <!-- /.timeline-label -->--}}

        @foreach($elementos as $bitacora)

            <!-- timeline item -->
            <div>
                <i class="fas fa-user bg-yellow"></i>

                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{fechaHoraLtn($bitacora->created_at)}}</span>
                    <h3 class="timeline-header"><a href="#">{{$bitacora->usuario->name ?? 'SISTEMA'}}</a> {{$bitacora->titulo}}</h3>
                    @if($bitacora->comentario)
                    <div class="timeline-body" >
                        {{$bitacora->comentario}}
                    </div>
                    @endif
                </div>
            </div>
            <!-- END timeline item -->
        @endforeach
    @endforeach

    <div >
        <i class="fas fa-clock bg-gray"></i>
    </div>
</div>

<div style="color: transparent !important;">
    texto relleno, texto relleno, texto relleno, texto relleno, texto relleno, texto relleno, texto relleno, texto relleno
</div>

