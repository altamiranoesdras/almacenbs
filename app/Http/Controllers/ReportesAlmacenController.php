<?php

namespace App\Http\Controllers;

use App\DataTables\ItemsAvencerDataTable;
use App\DataTables\Scopes\ScopeStockDataTable;
use App\DataTables\StockDataTable;
use App\Models\Item;
use App\Models\Kardex;
use App\Models\Stock;
use Barryvdh\Snappy\PdfWrapper;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
//                $kardex->saldo = $saldos[$kardex->id];
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
            ->delItem($primerKardex->item_id)
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
        $bodega_id = $request->bodega_id ?? null;
        $buscar = $request->buscar ?? null;
        $stock = $request->stock ?? null;
        $categoria_id = $request->categoria_id ?? null;
        $itemId = $request->item_id ?? null;

        $query = Stock::with(['item'])->whereHas('item');

        $queryItmes = Item::with('stocks')->whereHas('stocks');



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

        $stocks = $query
//            ->conIngresos()
            ->get();

        $items = $queryItmes->get();

//        dd($stocks->sum('cantidad'),$items->first()->toArray());



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
}
