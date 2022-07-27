<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Factura</title>
    <link rel='stylesheet' href='{{asset('css/bootstrap.min.css')}}' media='all' />
    <link rel='stylesheet' href='{{asset('css/factura.css')}}' media='all' />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.png')}}">
  </head>
  <body>

    <header class='clearfix'>
    <table width="100%">
      <tr>
        <td>
          <div id='logo'>
            <img src='{{asset('img/logo.png')}}' style="max-width: 400px;  height: 100px">
          </div>
        </td>
        <td align="right">
          <div id='company'>
            <h2 class='name'>{{config('app.nombre_negocio')}}</h2>
            <div>{{config('app.dire_negocio')}}</div>
            <div>{{config('app.muni_negocio').', '.config('app.depto_negocio').', '.config('app.pais_negocio')}}</div>
            <div>Tel: {{config('app.tel_negocio')}}</div>
            <div><a href='mailto:{{config('app.mail_negocio')}}'>{{config('app.mail_negocio')}}</a></div>
          </div>
        </td>
      </tr>
    </table>
  </header>
    <main style="height: auto">
      <div id='details'>
        <table width="100%">
          <tr>
            <td>
              <div id='client'>
                <div class='to'>Proveedor:</div>
                <h2 class='name'>{{$compra->proveedor->nombre}}</h2>
                <div class='email'>{{$compra->proveedor->nit}}</div>
              </div>
            </td>
            <td align="right">
              <div id='invoice'>
                @if($compra->serie and $compra->numero)
                <h1>Factura {{$compra->serie}}-{{$compra->numero}}</h1>
                @else
                  <h1>Orden de Compra</h1>
                @endif
                  <div class='date'>Fecha: {{($compra->created_at)}}</div>
                {{--<div class='date'>Due Date: 30/06/2014</div>--}}
              </div>
            </td>
          </tr>
        </table>
      </div>
      @include('compras.tabla_detalles',['compra' => $compra])
      <div class="text-muted">La Orden de Compra fue creada por: {{$compra->user->name}}</div>
      {{--<div id='thanks'>Gracias por su atención!</div>--}}
      {{--<div id='notices'>--}}
        {{--<div>NOTICE:</div>--}}
        {{--<div class='notice'>A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>--}}
      {{--</div>--}}
    </main>


  </body>
</html>