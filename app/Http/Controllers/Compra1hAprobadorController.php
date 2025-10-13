<?php

namespace App\Http\Controllers;

use App\DataTables\CompraAprobarDataTable;
use App\DataTables\Scopes\ScopeCompraDataTable;
use App\Models\Compra;
use App\Models\CompraEstado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * @throws \Throwable
     */
    public function regresar(Compra $compra, Request $request)
    {
        try {
            DB::beginTransaction();

            $compra->estado_id = CompraEstado::RETORNO_POR_APROBADOR;
            $compra->save();

            $compra->addBitacora('1H retornado por aprobador', "Motivo: ".$request->motivo ?? '');

        } catch (\Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);

            flash()->warning($msj);

            return back()->withInput();
        }

        DB::commit();

        flash('1H retornado al operador!')->success();

        return redirect()->route('bandejas.compras1h.aprobador');

    }
}
