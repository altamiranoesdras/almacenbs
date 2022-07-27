<div class="card mb-5 mb-lg-0">

    <div class="card-body">

        <h3 class="card-price text-center">
            {{ __($plan->nickname) }}<br>
            {{ dvs().$plan->amount}}   / mensual
        </h3>
        <hr>
        <ul class="fa-ul">

            <li>
                                        <span class="fa-li">
                                            <i class="fas fa-check text-success"></i>
                                        </span>
                {{$plan->cant_user." Usuarios"}}
            </li>
            <li>
                                        <span class="fa-li">
                                            <i class="fas fa-check text-success"></i>
                                        </span>
                {{$plan->cant_sucursales." Sucursales"}}
            </li>

            <li class="{{$plan->slug=='free' ? 'text-muted' : ''}}">
                                        <span class="fa-li">
                                            <i class="fas  {{$plan->slug=='free' ? 'text-danger fa-times' : 'fa-check text-success'}}" ></i>
                                        </span>
                {{ __("Facturación electrónica") }}
            </li>
            <li class="{{!$plan->s3 ? 'text-muted' : ''}}">
                                        <span class="fa-li">

                                            <i class="fas  {{!$plan->s3 ? 'text-danger fa-times' : 'fa-check text-success'}}"  ></i>
                                        </span>
                {{ __("Almacenamiento ilimitado") }}
            </li>
            <li class="{{!$plan->shop ? 'text-muted' : ''}}">
                                        <span class="fa-li">
                                            <i class="fas  {{!$plan->shop ? 'text-danger fa-times' : 'fa-check text-success'}}"  ></i>
                                        </span>
                E-Commerce ({{ __("Tu propia tienda en linea") }})
            </li>
            <li class="{{$plan->slug!='pro' ? 'text-muted' : ''}}">
                                        <span class="fa-li">
                                            <i class="fas  {{$plan->slug!='pro' ? 'text-danger fa-times' : 'fa-check text-success'}}" ></i>
                                        </span>
                {{ __("Soporte Premium") }}
            </li>

        </ul>


        <br>

        @if($urlVistaPagar)
            @if($plan->id==($actual->id ?? null))
                <button disabled class="btn btn-block btn-outline-secondary text-uppercase text-bold">
                    Plan Actual
                </button>

            @else
                <a href="{{$urlVistaPagar ?? '#'}}"
                   class="btn btn-block btn-outline-success text-uppercase text-bold">
                    {{__('Seleccionar')}}
                </a>
            @endif
        @endif


    </div>

</div>
