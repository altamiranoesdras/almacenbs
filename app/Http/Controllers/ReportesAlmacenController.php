<?php

namespace App\Http\Controllers;

use App\Models\Compra1h;
use App\Models\CompraEstado;
use DB;
use Exception;
use App\Models\Item;
use App\Models\Stock;
use App\Models\Bodega;
use App\Models\Kardex;
use Illuminate\Http\Request;
use Barryvdh\Snappy\PdfWrapper;
use App\DataTables\StockDataTable;
use Illuminate\Support\Facades\App;
use App\DataTables\ItemsAvencerDataTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\DataTables\Scopes\ScopeStockDataTable;

class ReportesAlmacenController extends AppBaseController
{
    /**
     * KardexController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function kardex(Request $request)
    {
        $item_id = $request->item_id ?? null;
        $item = null;
        $kardex = null;
        $buscar = $request->buscar ?? null;
        $saldo = 0;


        if ($buscar){

            $item = Item::find($item_id);

            /**
             * @var Collection $kardex
             */
            $kardex = Kardex::with(['model','item' => function($queryItem){
                    $queryItem->with(['unimed','stocks','marca','presentacion']);
                }])
                ->where('cantidad','>',0)
                ->delItem($item_id)
                ->orderBy('created_at','asc')
                ->get();


            $kardex = $kardex->sortBy('fecha_ordena_timestamp')->groupBy('folio');

//            return $kardex;


        }

        return view('reportes.kardex_por_item',compact('kardex','item','buscar','saldo'));
    }

    public function kardexShow(Request $request)
    {

        $item_id = $request->item_id ?? null;
        $item = null;
        $kardex = null;
        $buscar = $request->buscar ?? null;
        $saldo = 0;


        if ($buscar){

            $item = Item::find($item_id);

            /**
             * @var Collection $kardex
             */
            $kardex = Kardex::with(['model','item' => function($queryItem){
                    $queryItem->with(['unimed','stocks','marca','presentacion']);
                }])
                ->where('cantidad','>',0)
                ->delItem($item_id)
                ->orderBy('created_at','asc')
                ->get();


            $kardex = $kardex->sortBy('fecha_ordena_timestamp')->groupBy('folio');

//            return $kardex;


        }

        return view('reportes.kardex_por_item_show',compact('kardex','item','buscar','saldo'));
    }

    public function actualizaKardex($folio,Request $request)
    {

//        dd($request->all());


        try {
            DB::beginTransaction();


            $kardexs = Kardex::whereFolio($folio)
                ->where('cantidad','>',0)
                ->whereItemId($request->item_id)
                ->get();


            $impresos = $request->impresos;
            $preciosExistencia = $request->precios_existencia;
            $preciosMovimientos = $request->precios_movimiento;
            $codigosSalida = $request->codigos_salidas;
            $saldos = $request->saldos;


//            dd($preciosExistencia);

            /**
             * @var Kardex $kardex
             */
            foreach ($kardexs as $kardex) {



                if ($kardex->salida){
                    $codigo = $codigosSalida[$kardex->id] ?? null;
                    $kardex->codigo = $codigo;
                }

                $impreso = $impresos[$kardex->id] ?? 0;



                $kardex->impreso = $impreso;
                $kardex->precio_existencia = $preciosExistencia[$kardex->id];
                $kardex->precio_movimiento = $preciosMovimientos[$kardex->id];
                $kardex->saldo = $saldos[$kardex->id];
                $kardex->codigo_insumo = $request->codigo_insumo;
                $kardex->del = $request->del;
                $kardex->al = $request->al;
                $kardex->folio_siguiente = $request->folio_siguiente;
                $kardex->save();

            }



        } catch (Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);

            return redirect()->back()->withErrors([$msj])->withInput();
        }

        DB::commit();

        flash('Kardex actualizado')->success();

        return redirect(route('reportes.kardex')."?item_id=".$request->item_id."&buscar=1");

    }

    public function actualizaKardexAjax($folio,Request $request)
    {

//        dd($request->all());


        try {
            DB::beginTransaction();


            $kardexs = Kardex::whereFolio($folio)
                ->where('cantidad','>',0)
                ->whereItemId($request->item_id)
                ->get();


            $impresos = $request->impresos;
            $preciosExistencia = $request->precios_existencia;
            $preciosMovimientos = $request->precios_movimiento;
            $codigosSalida = $request->codigos_salidas;
            $saldos = $request->saldos;


//            dd($preciosExistencia);

            /**
             * @var Kardex $kardex
             */
            foreach ($kardexs as $kardex) {



                if ($kardex->salida){
                    $codigo = $codigosSalida[$kardex->id] ?? null;
                    $kardex->codigo = $codigo;
                }

                $impreso = $impresos[$kardex->id] ?? 0;
                $kardex->impreso = $impreso;
//                $kardex->precio_existencia = $preciosExistencia[$kardex->id];
//                $kardex->precio_movimiento = $preciosMovimientos[$kardex->id];
                $kardex->saldo = $saldos[$kardex->id];
//                $kardex->codigo_insumo = $request->codigo_insumo;
//                $kardex->del = $request->del;
//                $kardex->al = $request->al;
                $kardex->folio_siguiente = $request->folio_siguiente;
                $kardex->save();

            }



        } catch (Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);

            return redirect()->back()->withErrors([$msj])->withInput();
        }

        DB::commit();

        return $this->sendSuccess("Folio $folio actualizado");

    }

    public function kardexPdf($folio,Request $request)
    {


        /**
         * @var Kardex $primerKardex
         */
        $primerKardex = Kardex::whereFolio($folio)
            ->whereItemId($request->item)
            ->orderBy('created_at','asc')
            ->where('cantidad','>',0)
            ->first();

        /**
         * @var Collection $kardexs
         */
        $kardexs = Kardex::with(['item.unimed','item.marca'])
            ->where('cantidad','>',0)
            ->delItem($request->item)
            ->orderBy('created_at','asc')
            ->get();


        $folios = $kardexs->where('folio',$folio)->sortBy('fecha_ordena_timestamp')->groupBy('folio');

        //si el folio tiene detalles y el primer detalle esta para imprimir
        $imprimeEncabezado = $folios[$folio]->count() > 0  &&  $folios[$folio]->first()->impreso;

        //si el folio tiene detalles y el ultimo detalle esta para imprimir
        $fechaFinImprimeEncabezado = $folios[$folio]->count() > 0  &&  $folios[$folio]->last()->impreso;


        $siguienteFolio = $folios[$folio]->first()->folio_siguiente;


        /**
         * @var PdfWrapper $pdf
         */
        $pdf = App::make('snappy.pdf.wrapper');

        $view = view('reportes.kardex_por_item_pdf', compact('folios','imprimeEncabezado','fechaFinImprimeEncabezado'))->render();
         $footer = view('reportes.kardex_por_item_pdf_footer',compact('siguienteFolio'))->render();

//         return $view;
//        dd($solicitud->toArray());

        $pdf->loadHTML($view)
            ->setOption('page-width', 216)
            ->setOption('page-height', 330 )
            ->setOrientation('landscape')
             ->setOption('footer-html',utf8_decode($footer))
            ->setOption('margin-top', 45)
            ->setOption('margin-bottom',43)
            ->setOption('margin-left',18)
            ->setOption('margin-right',13);

        return $pdf->inline('Kardex folio '.$folio.'.pdf');


    }

    public function stock(StockDataTable $dataTable,Request $request)
    {
        $renglon = $request->renglon ?? null;
        $bodega_id = $request->bodega_id ?? Bodega::PRINCIPAL;
        $buscar = $request->buscar ?? null;
        $stock = $request->stock ?? null;
        $categoria_id = $request->categoria_id ?? null;
        $itemId = $request->item_id ?? null;
        $stocks = null;
        $items = null;

        $query = Stock::with(['item','bodega','rrhhUnidad' => function ($q) {
            $q->withoutAppends();
        }])->whereHas('item');

        $queryItmes = Item::with(['stocks' => function ($q) {
                $q->with(['rrhhUnidad' => function ($q) {
                    $q->withoutAppends();
                },'bodega']);
            }])
            ->whereHas('stocks');



        if ($itemId){
            $query = $query->whereHas('item',function (Builder $q) use ($itemId) {
                $q->where('item_id',$itemId);
            });

            $queryItmes = $queryItmes->where('id',$itemId);
        }


        if ($renglon){
            $query = $query->whereHas('item',function (Builder $q) use ($renglon){
                $q->where('renglon_id',$renglon);
            });

            $queryItmes = $queryItmes->where('renglon_id',$renglon);
        }


        if ($bodega_id){
            $query = $query->where('bodega_id',$bodega_id);

            $queryItmes = $queryItmes->whereHas('stocks',function (Builder $q) use ($bodega_id){
                $q->where('bodega_id',$bodega_id);
            });
        }

        if ($stock=="con_stock"){
            $query = $query->where('cantidad','!=','0');

            $queryItmes = $queryItmes->whereHas('stocks',function ($q){
                $q->where('cantidad','!=','0');
            });
        }


        if ($stock=="sin_stock"){

            $query = $query->where('cantidad','0');

            $queryItmes = $queryItmes->whereHas('stocks',function ($q){
                $q->where('cantidad','0');

            });
        }

        if ($categoria_id){
            $query = $query->whereHas('item',function (Builder $q) use ($categoria_id){
                $q->where('categoria_id',$categoria_id);
            });

            $queryItmes = $queryItmes->where('categoria_id',$categoria_id);
        }


        if ($buscar){
            $stocks = $query
//            ->conIngresos()
                ->get();

            $items = $queryItmes->get();
        }

        return view('reportes.stock.index_old',compact('stocks','items','renglon','bodega_id','stock','buscar'));

    }

    public function actualizaStock(Request $request)
    {

        $fechas = $request->fechas_vence ?? [];

        try {
            DB::beginTransaction();

            foreach ($fechas as $stock_id => $fecha) {

                $stock = Stock::find($stock_id);

                if ($stock->fecha_vence != $fecha){
                    $stock->fecha_vence = $fecha;
                    $stock->save();
                }

            }

        } catch (Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);

            return redirect()->back()->withErrors([$msj])->withInput();
        }

        DB::commit();

        flash('Stock actualizado')->success();

        return redirect()->back();

    }

    public function itemsAvencer(ItemsAvencerDataTable $dataTable,Request $request)
    {

        $scope = new ScopeStockDataTable();

        $dataTable->addScope($scope);

        return $dataTable->render('items.reportes.proximos_a_vencer');

    }

    public function nuevoFolio(Kardex $kardex)
    {

        if (!$kardex){
            flash('No se encontró el kardex')->error();
            return redirect()->back();
        }

        try {
            DB::beginTransaction();


            $folio = $kardex->siguienteFolio(true);

            $kardex->folio = $folio;
            $kardex->save();

            $kardex->addBitacora('Se generó un nuevo folio '.$folio,'',auth()->user()->id);

        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);
        }

        DB::commit();

        flash('El ultimo movimiento se le asignó el nuevo folio '.$folio)->success();

        return redirect()->back();
    }

    public function existenciaInsumos(Request $request)
    {
        $items = Item::with('stocks')
        ->whereHas('stocks')
        ->get();

        // dd($items->toArray());

        return view('reportes.existencia_insumo',[
            'items' => $items,
        ]);
    }

    // Reporte 2: Existencia por Unidad Solicitante
    public function existenciaPorUnidadSolicitante(Request $request)
    {
        $unidades_seleccionadas = $request->unidades_seleccionadas ?? [];
        $fecha_desde = $request->fecha_desde ?? null;
        $fecha_hasta = $request->fecha_hasta ?? null;

        $stocks = collect();

        if(count($unidades_seleccionadas) > 0){

            $query = Stock::whereHas('item')
                ->with(['item' => function($query) {
                    $query->withOutAppends()
                        ->with(['unimed', 'presentacion','ultimaSolicitud']);
                }])
                ->with(['rrhhUnidad'])
                ->where('bodega_id', Bodega::PRINCIPAL)
                ->whereIn('unidad_id', $unidades_seleccionadas);

            $stocks = $query->get();
        }

        return view('reportes.existencia_por_unidad_solicitante', compact('stocks', 'unidades_seleccionadas', 'fecha_desde', 'fecha_hasta'));
    }

    // Reporte 2: Existencia por Unidad Solicitante
    public function misExistencias(Request $request)
    {
        $usuario = usuarioAutenticado();

        if (!$usuario->unidad_id || !$usuario->bodega_id) {
            flash('No se encontró la unidad o bodega asociada al usuario.')->error();
            return redirect()->back();
        }


        $query = Stock::whereHas('item')
            ->with(['item' => function($query) {
                $query->withOutAppends()
                    ->with(['unimed', 'presentacion']);
            }])
            ->where('bodega_id', Bodega::PRINCIPAL)
            ->where('unidad_id', $usuario->unidad_id);
//                ->where('cantidad', '>', 0);

        $existenciasEnBodegaCentral = $query->get();

        $queryUnidad = Stock::whereHas('item')
            ->with(['item' => function($query) {
                $query->withOutAppends()
                    ->with(['unimed', 'presentacion']);
            }])
            ->where('bodega_id', $usuario->bodega_id);
//                ->where('cantidad', '>', 0);

        $existenciasEnBodegaDeUnidad = $queryUnidad->get();


        return view('reportes.mis_existencias_por_unidad_solicitante', compact('existenciasEnBodegaCentral', 'existenciasEnBodegaDeUnidad'));
    }

    // Reporte 3: Existencia por Subsecretaría
    public function existenciaPorSubsecretaria(Request $request)
    {
        $subsecretaria_id = $request->subsecretaria_id ?? null;
        $fecha_desde = $request->fecha_desde ?? null;
        $fecha_hasta = $request->fecha_hasta ?? null;

        $query = Item::with(['stocks', 'solicitudDetalles.solicitud.unidad'])
            ->whereHas('stocks')
            ->whereHas('solicitudDetalles.solicitud.unidad', function($q) use ($subsecretaria_id) {
                if ($subsecretaria_id) {
                    $q->where('unidad_padre_id', $subsecretaria_id);
                }
            });

        if ($fecha_desde && $fecha_hasta) {
            $query->whereHas('solicitudDetalles.solicitud', function($q) use ($fecha_desde, $fecha_hasta) {
                $q->whereBetween('created_at', [$fecha_desde, $fecha_hasta]);
            });
        }

        $items = $query->get();

        $subsecretarias = \App\Models\RrhhUnidad::whereNull('unidad_padre_id')
            ->whereHas('children', function($q) {
                $q->where('solicita', 'si');
            })
            ->get();

        return view('reportes.existencia_por_subsecretaria', compact('items', 'subsecretarias', 'subsecretaria_id', 'fecha_desde', 'fecha_hasta'));
    }

    // Reporte 4: Existencia Periódicas (Semanales y Mensuales)
    public function existenciaPeriodicas(Request $request)
    {
        $tipo_periodo = $request->tipo_periodo ?? 'semanal';
        $fecha_especifica = $request->fecha_especifica ?? now()->format('Y-m-d');

        $items = Item::with(['stocks', 'solicitudDetalles.solicitud'])
            ->whereHas('stocks')
            ->whereHas('solicitudDetalles', function($q) use ($tipo_periodo, $fecha_especifica) {
                if ($tipo_periodo === 'semanal') {
                    $q->whereBetween('created_at', [
                        \Carbon\Carbon::parse($fecha_especifica)->startOfWeek(),
                        \Carbon\Carbon::parse($fecha_especifica)->endOfWeek()
                    ]);
                } else {
                    $q->whereMonth('created_at', \Carbon\Carbon::parse($fecha_especifica)->month)
                       ->whereYear('created_at', \Carbon\Carbon::parse($fecha_especifica)->year);
                }
            })
            ->get();

        return view('reportes.existencia_periodicas', compact('items', 'tipo_periodo', 'fecha_especifica'));
    }

    // Reporte 5: Ingresos y Egresos Diarios
    public function ingresosEgresosDiarios(Request $request)
    {
        $fecha_desde = $request->fecha_desde ?? now()->format('Y-m-d');
        $fecha_hasta = $request->fecha_hasta ?? now()->format('Y-m-d');

        $kardex = Kardex::with(['item', 'model'])
            ->whereBetween('created_at', [$fecha_desde . ' 00:00:00', $fecha_hasta . ' 23:59:59'])
            ->where('cantidad', '>', 0)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('reportes.ingresos_egresos_diarios', compact('kardex', 'fecha_desde', 'fecha_hasta'));
    }

    // Reporte 6: 1-H elaborados mensuales
    public function unoHElaboradosMensuales(Request $request)
    {
        $fecha_desde = $request->fecha_desde ?? now()->startOfMonth()->format('Y-m-d');
        $fecha_hasta = $request->fecha_hasta ?? now()->endOfMonth()->format('Y-m-d');

        $compras1h = \App\Models\Compra1h::with(['compra.proveedor', 'compra.detalles.item'])
            ->whereBetween('fecha_procesa', [$fecha_desde, $fecha_hasta])
            ->whereHas('compra', function($q) {
                $q->whereIn('estado_id', [
                    CompraEstado::UNO_H_AUTORIZADO,
                    CompraEstado::ANULADO
                ]);
            })
            ->orderBy('fecha_procesa', 'desc')
            ->get();

        $conteoAnuladas = $compras1h->where('compra.estado_id', CompraEstado::ANULADO)->count();
        $conteoAutorizadas = $compras1h->where('compra.estado_id', CompraEstado::UNO_H_AUTORIZADO)->count();

        $montoTotal = $compras1h->sum(function(Compra1h $compra1h) {
            return $compra1h->compra->estaAutorizado1h() ? $compra1h->compra->total : 0;
        });

        return view('reportes.uno_h_elaborados_mensuales',
            compact(
                'compras1h',
                'fecha_desde',
                'fecha_hasta',
                'conteoAutorizadas',
                'conteoAnuladas',
                'montoTotal'
            )
        );
    }

    // Reporte 7: Reporte de Antigüedad de Inventario (Existencias)
    public function antiguedadInventario(Request $request)
    {
        $fecha_desde = $request->fecha_desde ?? null;
        $fecha_hasta = $request->fecha_hasta ?? now()->format('Y-m-d');

        $items = Item::with(['stocks' => function($q) use ($fecha_desde, $fecha_hasta) {
            if ($fecha_desde) {
                $q->whereBetween('fecha_ing', [$fecha_desde, $fecha_hasta]);
            }
        }])
        ->whereHas('stocks', function($q) {
            $q->where('cantidad', '>', 0);
        })
        ->get();

        return view('reportes.antiguedad_inventario', compact('items', 'fecha_desde', 'fecha_hasta'));
    }

    // Reporte 8: Reporte de Movimiento por Tipo
    public function movimientoPorTipo(Request $request)
    {
        $tipo_movimiento = $request->tipo_movimiento ?? null;
        $fecha_desde = $request->fecha_desde ?? now()->startOfMonth()->format('Y-m-d');
        $fecha_hasta = $request->fecha_hasta ?? now()->endOfMonth()->format('Y-m-d');

        $query = Kardex::with(['item', 'model'])
            ->whereBetween('created_at', [$fecha_desde . ' 00:00:00', $fecha_hasta . ' 23:59:59'])
            ->where('cantidad', '>', 0);

        if ($tipo_movimiento) {
            $query->where('tipo', $tipo_movimiento);
        }

        $movimientos = $query->orderBy('created_at', 'desc')->get();

        return view('reportes.movimiento_por_tipo', compact('movimientos', 'tipo_movimiento', 'fecha_desde', 'fecha_hasta'));
    }

    // Reporte 9: Reporte de Movimientos de Compra por Proveedor
    public function movimientosCompraPorProveedor(Request $request)
    {
        $proveedor_id = $request->proveedor_id ?? null;
        $fecha_desde = $request->fecha_desde ?? now()->startOfMonth()->format('Y-m-d');
        $fecha_hasta = $request->fecha_hasta ?? now()->endOfMonth()->format('Y-m-d');

        $compras = \App\Models\Compra::with(['detalles.item', 'proveedor'])
            ->whereHas('detalles')
            ->when($proveedor_id, function($q) use ($proveedor_id) {
                $q->where('proveedor_id', $proveedor_id);
            })
            ->whereBetween('fecha_ingreso', [$fecha_desde, $fecha_hasta])
            ->orderBy('fecha_ingreso', 'desc')
            ->get();

        $proveedores = \App\Models\Proveedor::all();

        return view('reportes.movimientos_compra_por_proveedor', compact('compras', 'proveedores', 'proveedor_id', 'fecha_desde', 'fecha_hasta'));
    }

    // Reporte 10: Reporte de Listado de Operaciones por Empleado
    public function operacionesPorEmpleado(Request $request)
    {
        $empleado_id = $request->empleado_id ?? null;
        $fecha_desde = $request->fecha_desde ?? now()->startOfMonth()->format('Y-m-d');
        $fecha_hasta = $request->fecha_hasta ?? now()->endOfMonth()->format('Y-m-d');

        $operaciones = Kardex::with(['item', 'usuario'])
            ->whereBetween('created_at', [$fecha_desde . ' 00:00:00', $fecha_hasta . ' 23:59:59'])
            ->when($empleado_id, function($q) use ($empleado_id) {
                $q->where('usuario_id', $empleado_id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $empleados = \App\Models\User::whereHas('kardexes')->get();

        // Estadísticas
        $estadisticas = [
            'total_operaciones' => $operaciones->count(),
            'operaciones_asignadas' => $operaciones->where('usuario_id', $empleado_id)->count(),
            'operaciones_completadas' => $operaciones->where('usuario_id', $empleado_id)->whereNotNull('saldo')->count(),
            'tiempo_promedio' => $operaciones->where('usuario_id', $empleado_id)->avg('created_at')->diffInHours(now())
        ];

        return view('reportes.operaciones_por_empleado', compact('operaciones', 'empleados', 'empleado_id', 'fecha_desde', 'fecha_hasta', 'estadisticas'));
    }

    // Reporte 11: Reporte de Registro de Control de Inventario
    public function registroControlInventario(Request $request)
    {
        $items = Item::with(['stocks', 'presentacion', 'unimed'])
            ->whereHas('stocks', function($q) {
                $q->where('cantidad', '>', 0);
            })
            ->orderBy('nombre')
            ->get();

        return view('reportes.registro_control_inventario', compact('items'));
    }

    // Reporte 12: Reporte Movimiento de Salidas por Unidad y Subsecretaría
    public function movimientoSalidasPorUnidad(Request $request)
    {
        $unidad_id = $request->unidad_id ?? null;
        $subsecretaria_id = $request->subsecretaria_id ?? null;
        $fecha_desde = $request->fecha_desde ?? now()->startOfMonth()->format('Y-m-d');
        $fecha_hasta = $request->fecha_hasta ?? now()->endOfMonth()->format('Y-m-d');

        $query = \App\Models\Solicitud::with(['detalles.item', 'unidad'])
            ->where('estado_id', \App\Models\SolicitudEstado::DESPACHADA)
            ->whereBetween('fecha_despacha', [$fecha_desde, $fecha_hasta]);

        if ($unidad_id) {
            $query->where('unidad_id', $unidad_id);
        }

        if ($subsecretaria_id) {
            $query->whereHas('unidad', function($q) use ($subsecretaria_id) {
                $q->where('unidad_padre_id', $subsecretaria_id);
            });
        }

        $solicitudes = $query->orderBy('fecha_despacha', 'desc')->get();

        $unidades = \App\Models\RrhhUnidad::where('solicita', 'si')->get();
        $subsecretarias = \App\Models\RrhhUnidad::whereNull('unidad_padre_id')
            ->whereHas('children', function($q) {
                $q->where('solicita', 'si');
            })
            ->get();

        return view('reportes.movimiento_salidas_por_unidad', compact('solicitudes', 'unidades', 'subsecretarias', 'unidad_id', 'subsecretaria_id', 'fecha_desde', 'fecha_hasta'));
    }

    public function comparaKardexStock()
    {
        $insumos = Item::query()
            ->withoutAppends()
            ->with(['stocks','kardexs','unimed'])
            ->whereHas('stocks')
            ->whereHas('kardexs')
            ->get();

        return view('reportes.compara_kardex_stock',compact('insumos'));

    }
}
