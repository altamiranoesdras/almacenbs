<?php

namespace App\Http\Controllers;

use App\DataTables\CompraAprobarDataTable;
use App\DataTables\Scopes\ScopeCompraDataTable;
use App\Models\Compra;
use App\Models\CompraEstado;
use App\Models\Role;
use App\Models\User;
use App\Notifications\IngresoAlmacen\IngresoAlmacenEnviadoNotificaction;
use App\Notifications\IngresoAlmacen\IngresoAlmacenRetornadoNotificaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Notification;

class Compra1hAprobadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CompraAprobarDataTable $dataTable)
    {
        $scope = new ScopeCompraDataTable();
        $scope->estados = [
            CompraEstado::UNO_H_OPERADO,
            CompraEstado::RETORNO_POR_AUTORIZADOR,

        ];
        $dataTable->addScope($scope);

        return $dataTable->render('compras.aprobar.index');
    }

    public function buscador(CompraAprobarDataTable $dataTable)
    {
        $scope = new ScopeCompraDataTable();
        $scope->estados = [
            CompraEstado::UNO_H_APROBADO,
            CompraEstado::UNO_H_AUTORIZADO,
            CompraEstado::RETORNO_POR_APROBADOR,
            CompraEstado::ANULADO,
        ];

        $scope->usuario_aprueba = auth()->user()->id;
        $dataTable->addScope($scope);

        return $dataTable->render('compras.aprobar.buscador');

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

        $this->notificarCompraFueAprobada($compra);

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

            $usuarioOpera = $compra->usuarioOpera;
            $usuarioOpera->notify(new IngresoAlmacenRetornadoNotificaction($compra, route('bandejas.compras1h.operador')));

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

    public function notificarCompraFueAprobada($compra)
    {
        $usuariosAutorizadores = User::whereHas('roles', function ($query) {
            $query->where('id', Role::AUTORIZADOR_DE_INGRESOS_ALMACEN_1H);
        })->get();

        Notification::send($usuariosAutorizadores, new IngresoAlmacenEnviadoNotificaction($compra, route('bandejas.compras1h.autorizador')));

    }
}
