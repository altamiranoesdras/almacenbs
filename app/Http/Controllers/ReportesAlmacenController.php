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

class ReportesAlmacenController extends Controller
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
            $kardex = Kardex::with(['item' => function($queryItem){
                $queryItem->with(['unimed','stocks','marca','presentacion']);
            }])
                ->delItem($item_id)
                ->orderBy('created_at','asc')
                ->get();


            $kardex = $kardex->groupBy('folio');


        }

        return view('reportes.kardex_por_item',compact('kardex','item','buscar','saldo'));
    }

    public function actualizaKardex($folio,Request $request)
    {



        try {
            DB::beginTransaction();


            Kardex::whereFolio($folio)->update([
                "codigo_insumo" => $request->codigo_insumo,
                "del" => $request->del,
                "al" => $request->al,
            ]);

            foreach ($request->codigos_salidas as $id => $codigo) {

                if ($id && $codigo){

                    Kardex::find($id)->update([
                        'codigo' => $codigo
                    ]);
                }

            }

        } catch (Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);

            return redirect()->back()->withErrors([$msj])->withInput();
        }

        DB::commit();

        return redirect(route('reportes.kardex')."?item_id=".$request->item_id."&buscar=1");

    }

    public function kardexPdf($folio)
    {


        /**
         * @var Kardex $kardex
         */
        $kardex = Kardex::with(['item.unimed','item.marca'])
            ->whereFolio($folio)
            ->orderBy('created_at','asc')
            ->first();

        /**
         * @var Collection $kardexs
         */
        $kardexs = Kardex::with(['item.unimed','item.marca'])
            ->delItem($kardex->item_id)
            ->orderBy('created_at','asc')
            ->get();


        $kardex = $kardexs->where('folio',$folio)->groupBy('folio');

        $siguienteFolio = 0;

        /**
         * @var PdfWrapper $pdf
         */
        $pdf = App::make('snappy.pdf.wrapper');

        $view = view('reportes.kardex_por_item_pdf', compact('kardex'))->render();
         $footer = view('reportes.kardex_por_item_pdf_footer',compact('siguienteFolio'))->render();

//         return $view;
//        dd($solicitud->toArray());

        $pdf->loadHTML($view)
            ->setOption('page-width', 216)
            ->setOption('page-height', 279)
            ->setOrientation('landscape')
             ->setOption('footer-html',utf8_decode($footer))
            ->setOption('margin-top', 45)
            ->setOption('margin-bottom',3)
            ->setOption('margin-left',15)
            ->setOption('margin-right',14);

        return $pdf->inline('Kardex folio '.$folio.'.pdf');


    }

    public function stock(StockDataTable $dataTable,Request $request)
    {
        $renglon = $request->renglon ?? null;
        $bodega_id = $request->bodega_id ?? null;
        $buscar = $request->buscar ?? null;
        $stock = $request->stock ?? null;

        $query = Stock::with(['item'])->whereHas('item');


        if ($renglon){
            $query = $query->whereHas('item',function (Builder $q) use ($renglon){
                $q->where('renglon_id',$renglon);
            });
        }

        if ($bodega_id){
            $query = $query->where('bodega_id',$bodega_id);
        }

        if ($stock=="con_stock"){
            $query = $query->where('cantidad','!=','0');
        }


        if ($stock=="sin_stock"){

            $query = $query->where('cantidad','0');
        }

        $stocks = $query
//            ->conIngresos()
            ->get();

        return view('reportes.stock.index_old',compact('stocks','renglon','bodega_id','stock','buscar'));

    }

    public function itemsAvencer(ItemsAvencerDataTable $dataTable,Request $request)
    {

        $scope = new ScopeStockDataTable();

        $dataTable->addScope($scope);

        return $dataTable->render('items.reportes.proximos_a_vencer');

    }
}
