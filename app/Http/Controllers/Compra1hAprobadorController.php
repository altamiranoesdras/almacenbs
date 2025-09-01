<?php

namespace App\Http\Controllers;

use App\DataTables\CompraAprobarDataTable;
use App\DataTables\Scopes\ScopeCompraDataTable;
use App\Models\Compra;
use App\Models\CompraEstado;
use Illuminate\Http\Request;

class Compra1hAprobadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CompraAprobarDataTable $dataTable)
    {
        $scope = new ScopeCompraDataTable();
        $scope->estados = [CompraEstado::UNO_H_OPERADO];
        $dataTable->addScope($scope);

        return $dataTable->render('compras.aprobar.index');
    }

    public function gestionar($id)
    {
        $compra = Compra::with([
            'proveedor',
            'detalles.item' => function ($query) {
                $query->withOutAppends();
            },
            'estado',
            'compra1h.detalles.item' => function ($query) {
                $query->withOutAppends();
            },
        ])
            ->where('id', $id)
            ->firstOrFail();

        return view('compras.aprobar.gestionar', compact('compra'));
    }

    public function procesar(Compra $compra, Request $request)
    {

        $compra->aprobar1h($request->observaciones ?? '');

        flash('Formulario 1H aprobado!')->success();

        return redirect()->route('bandejas.compras1h.aprobador');

    }
}
