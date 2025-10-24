<?php

namespace App\Http\Controllers;

use App\DataTables\CompraAutorizarDataTable;
use App\DataTables\Scopes\ScopeCompraDataTable;
use App\Exceptions\InsumosSinCategriaException;
use App\Models\Compra;
use App\Models\CompraEstado;
use App\Notifications\IngresoAlmacen\IngresoAlmacenEnviadoNotificaction;
use App\Notifications\IngresoAlmacen\IngresoAlmacenRetornadoNotificaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        try {
            DB::beginTransaction();

            $compra->autorizar1h($request->observaciones ?? '');

            //$this->notificarCompraFueAutorizada($compra);

        }catch ( InsumosSinCategriaException $exception) {
            DB::rollBack();

            flash()->warning($exception->getMessage());

            return back()->withInput();
        }
        catch (Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);
            flash()->warning($msj);
            return back()->withInput();
        }

        DB::commit();

        flash('Formulario 1H autorizado!')->success();

        return redirect()->route('bandejas.compras1h.autorizador');
    }

    /**
     * @throws \Throwable
     */
    public function regresar(Compra $compra, Request $request)
    {
        try {
            DB::beginTransaction();

            $compra->retornarAAprobador1h($request->motivo ?? '');

            if ($usuarioAprueba = $compra->usuarioAprueba){
                $usuarioAprueba->notify(new IngresoAlmacenRetornadoNotificaction($compra, route('bandejas.compras1h.aprobador')));
            }

        } catch (\Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);

            flash()->warning($msj);

            return back()->withInput();
        }

        DB::commit();

        flash('1H retornado al aprobador!')->success();

        return redirect()->route('bandejas.compras1h.autorizador');

    }

    public function notificarCompraFueAutorizada(Compra $compra)
    {
        $operador = $compra->usuarioOpera;
        $aprobador = $compra->usuarioAprueba;

        if ($operador){
            $operador->refresh();
            $operador->notify(new IngresoAlmacenEnviadoNotificaction($compra, route('bandejas.compras1h.operador')));
        }

        if ($aprobador) {
            $aprobador->refresh();
            $aprobador->notify(new IngresoAlmacenEnviadoNotificaction($compra, route('bandejas.compras1h.aprobador')));
        }

    }
}
