<?php

namespace App\Http\Controllers;

use App\DataTables\CompraAutorizarDataTable;
use App\DataTables\Scopes\ScopeCompraDataTable;
use App\Models\CompraEstado;
use Illuminate\Http\Request;

class Compra1hAutorizadorController extends Controller
{
    public function index(CompraAutorizarDataTable $dataTable)
    {
        $scope = new ScopeCompraDataTable();
        $scope->estados = [CompraEstado::UNO_H_APROBADO];
        $dataTable->addScope($scope);

        return $dataTable->render('compras.autorizar.index');
    }


    public function procesar(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);

        $fecha = $request->input('fecha');
        $hora = $request->input('hora');

        // Aquí iría la lógica para procesar la compra 1 hora operador
        // Por ejemplo, llamar a un servicio o realizar alguna operación

        // Para este ejemplo, simplemente retornamos una vista de éxito
        return view('compra1hoperador.success', compact('fecha', 'hora'));
    }
}
