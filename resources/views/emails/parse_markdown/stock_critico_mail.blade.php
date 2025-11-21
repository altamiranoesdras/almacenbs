<table border="1">
    <thead>
    <tr>
        <th>Código Insumo</th>
        <th>Código Presentación</th>
        <th>Nombre Insumo</th>
        <th>Existencia Actual</th>
    </tr>
    </thead>
    <tbody>
    @foreach($itemsStockCritico as $item)
        <tr>
            <td> {{ $item->codigo_insumo }} </td>
            <td> {{ $item->codigo_presentacion }} </td>
            <td> {{ $item->nombre }} </td>
            <td> {{ $item->stock_bodega }} </td>
        </tr>
    @endforeach
    </tbody>
</table>
