
<div class="row">
    <div class="col-sm-6">
        <!-- Tipo Field -->
        {!! Form::label('tipo', 'Tipo:') !!}
        {!! $compra->tipo->nombre ?? '' !!}
        <br>

        <!-- Proveedore Id Field -->
        {!! Form::label('proveedor', 'Proveedor :') !!}
        {!! $compra->proveedor->razon_social ?? '' !!}
        <br>

        @if($compra->serie != null && $compra->numero != null)
            <!-- Serie Field -->
            {!! Form::label('serie', 'S/N:') !!}
            {!! $compra->serie !!}-{!! $compra->numero !!}
            <br>
        @endif

        @if($compra->recibo_de_caja != null)
            <b>Recibo de Caja:</b>
            {!! $compra->recibo_de_caja !!}
            <br>
        @endif


        <!-- Fecha ingreso Field-->
        {!! Form::label('fecha_ingreso', 'Fecha Recepción:') !!}
        {!! fechaLtn($compra->fecha_ingreso)!!}

        <br>
    </div>
    <div class="col-sm-6">

        <!-- Fecha del documento Field -->
        {!! Form::label('fecha', 'Fecha del documento:') !!}
        {!! fechaLtn($compra->fecha_documento)!!}

        <br>


        <!-- Estado Id Field -->
        {!! Form::label('estado', 'Estado:') !!}
        <b>
        {!! $compra->estado->nombre !!}
        </b>
        <br>

        <!-- CompraEstado Id Field -->
        {!! Form::label('observaciones', 'Observaciones:') !!}
        {!! $compra->observaciones !!}
        <br>

        {{--<!-- Created At Field -->--}}
        {{--{!! Form::label('created_at', 'Creado el:') !!}--}}
        {{--{!! $compra->created_at !!}--}}
        {{--<br>--}}
        {{--<!-- Updated At Field -->--}}
        {{--{!! Form::label('updated_at', 'Actualizado el:') !!}--}}
        {{--{!! $compra->updated_at !!}--}}
        {{--<br>--}}
        {{--<br>--}}


    </div>
</div>
