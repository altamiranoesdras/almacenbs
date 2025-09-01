<?php

namespace App\Http\Controllers;

use App\DataTables\CompraAutorizarDataTable;
use App\DataTables\Scopes\ScopeCompraDataTable;
use App\Models\Compra;
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

        return view('compras.autorizar.gestionar', compact('compra'));
    }

    public function procesar(Compra $compra, Request $request)
    {
        $compra->autorizar1h($request->observaciones ?? '');

        flash('Formulario 1H autorizado!')->success();

        return redirect()->route('bandejas.compras1h.autorizador');
    }
}
