<table border="1">
    <thead>
    <tr>
        <th>Código</th>
        <th>Artículo</th>
        <th>Stock alcanzado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($itemsStockCritico as $item)
        <tr>
            <td> {{ $item->codigo }} </td>
            <td> {{ $item->nombre }} </td>
            <td> {{ $item->stock_bodega }} </td>
        </tr>
    @endforeach
    </tbody>
</table>
