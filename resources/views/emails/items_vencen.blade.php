@component('mail::layout')

@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        <img src="{{getLogo()}}" style="max-height: 10rem">
{{--        <br>--}}
{{--        {{config('app.name')}}--}}
    @endcomponent
@endslot

# @lang('Hello!') {{$user->name}}

@lang('The following items are about to expire')

@component('mail::table')
| No.   | Código    | Articulo       |  Fecha Vence   |  Cantidad  |
| ----- |:--------- | --------------:| --------------:| ----------:|
@foreach($stocks as $index => $stock)
| {{$index+1}} |   {{$stock->item->codigo}} |   {{$stock->item->nombre}} |   {{fecha($stock->fecha_ven)}} |   {{nf($stock->cantidad)}} |
@endforeach

@endcomponent


@component('mail::button', ['url' => route('rpt.items.vencen')])
    Reporte Perecederos
@endcomponent



@lang('Regards'),<br>
{{ config('app.name') }}

@slot('footer')
    @component('mail::footer')
         <strong>Desarrollado por: <a href="https://solucionesaltamirano.com/" target="_blank" rel="noreferrer">Soluciones Altamirano</a>.</strong> © {{ date('Y') }}  @lang('All rights reserved').
    @endcomponent
@endslot
@endcomponent

