<div class='card'>"+
    "<div class='card-body'>"+
        "<div class='row' >"+
            "<div class='col-sm-2'>"+
                "<a href='{!! $imagen !!}' data-fancybox  id='fancy-box-img-item-show' tabindex='1000'>"+
                    "<img src='{!! $imagen !!}' class='img-fluid img-show-bar' style='' id='img-item-show'>"+
                "</a>"+
            "</div>"+
            "<div class='col-sm-10'>"+
                "<div class='select2-result__nombre'>{{$marca ?? 'marca'}}</div>"+
                "<div class='select2-result__precio'><i class='far fa-money-bill-alt'></i> {{dvs()}} {{$precio}} </div>"+
                "<div class='select2-result__stock'><i class='fas fa-cubes'></i> {{$stock ?? ''}} </div>"+
                "<div class='select2-result__ubicacion'><i class='fas fa-archive'></i> {{$ubicacion ?? ''}} </div>"+
                "<div class='' style='margin-bottom: 4px'>Mayoreo: <b>{{ dvs() }} {{$precio_mayoreo}} / {{$cantidad_mayoreo}} o mas</b></div>"+
                "<div class='select2-result__contiene'>{{$descripcion ?? 'descripcion'}}</div>"+
                "</div>"+
        "</div>"+
    "</div>"+
"</div>