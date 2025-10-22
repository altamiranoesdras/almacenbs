<?php

namespace App\Http\Controllers;

use App\DataTables\CompraOperarDataTable;
use App\DataTables\Scopes\ScopeCompraDataTable;
use App\Models\Compra;
use App\Models\Compra1h;
use App\Models\CompraEstado;
use App\Models\Role;
use App\Models\User;
use App\Notifications\IngresoAlmacen\IngresoAlmacenEnviadoNotificaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Notification;

class Compra1hOperadorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CompraOperarDataTable $dataTable)
    {

        $scoper = new ScopeCompraDataTable();
        $scoper->estados = [
            CompraEstado::PROCESADO_PENDIENTE_RECIBIR,
            CompraEstado::RETORNO_POR_APROBADOR,
            CompraEstado::INGRESADO
        ];

        $dataTable->addScope($scoper);

        return $dataTable->render('compras.operar.index');
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

        return view('compras.operar.gestionar', compact('compra'));
    }

    public function genera1h(Compra $compra)
    {
        try {
            DB::beginTransaction();

            $compra->genera1h(request()->folio);

        } catch (\Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);

            flash()->warning($msj);

            return back()->withInput();
        }

        DB::commit();

        flash('1H generado!')->success();

        return redirect()->back();
    }


    public function procesar(Compra $compra, Request $request)
    {

        /** @var Compra1h $compra1h */
        $compra1h = $compra->compra1h;

        if (empty($compra1h)) {
            flash()->error('1H no encontrado');

            return redirect(route('compra1hs.index'));
        }

        try {
            DB::beginTransaction();


            $compra1h->fill($request->all());
            $compra1h->save();

            foreach ($compra1h->detalles as $index => $detalle) {
                $detalle->texto_extra = $request->textos_extras[$detalle->id] ?? null;
                $detalle->folio_almacen = $request->folios_almacen[$detalle->id] ?? null;
                $detalle->folio_inventario = $request->folios_inventario[$detalle->id] ?? null;
                $detalle->codigo_inventario = $request->codigos_inventario[$detalle->id] ?? null;
                $detalle->save();
            }

            if ($request->has('enviarAprobacion')) {
                $compra->operar1h();
                $this->notificarCompraFueAprobada($compra);
                $mnj = '1H enviado a aprobación con éxito.';
            } else {
                $mnj = '1H actualizado con éxito.';
                $compra->addBitacora($mnj);
            }

        } catch (Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);

            flash()->warning($msj);

            return back()->withInput();
        }

        DB::commit();


        flash()->success($mnj);

        if ($request->has('enviarAprobacion')){

            return redirect(route('bandejas.compras1h.operador'));
        }
        else{

            return redirect(route('bandejas.compras1h.operador.gestionar', $compra->id));
        }

    }

    public function notificarCompraFueAprobada(Compra $compra): void
    {
        $usuariosAprobadores = User::whereHas('roles', function ($query) {
            $query->where('id', Role::APROBADOR_DE_INGRESOS_ALMACEN_1H);
        })->get();

        Notification::send($usuariosAprobadores, new IngresoAlmacenEnviadoNotificaction($compra, route('bandejas.compras1h.aprobador')));

    }

}
