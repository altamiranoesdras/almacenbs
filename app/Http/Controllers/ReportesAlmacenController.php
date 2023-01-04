<?php

namespace App\Http\Controllers;

use App\DataTables\ItemsAvencerDataTable;
use App\DataTables\Scopes\ScopeStockDataTable;
use App\DataTables\StockDataTable;
use App\Models\Kardex;
use App\Models\Stock;
use Barryvdh\Snappy\PdfWrapper;
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
        $buscar = $request->buscar ?? null;
        $saldo = 0;


        /**
         * @var Collection $kardex
         */
        $kardex = Kardex::delItem($item_id)
            ->orderBy('created_at','asc')
            ->get();


        $kardex = $kardex->groupBy('folio');



        return view('reportes.kardex_por_item',compact('kardex','item_id','buscar','saldo'));
    }

    public function kardexPdf($folio)
    {


        /**
         * @var Collection $kardex
         */
        $kardex = Kardex::whereFolio($folio)
            ->orderBy('created_at','asc')
            ->get();

        return $kardex;

        /**
         * @var PdfWrapper $pdf
         */
        $pdf = App::make('snappy.pdf.wrapper');

        $view = view('reportes.kardex_por_item_pdf', compact('solicitud'))->render();
        // $footer = view('compras.pdf_footer')->render();

//        dd($solicitud->toArray());

        $pdf->loadHTML($view)
            ->setOption('page-width', '220')
            ->setOption('page-height', '280')
            ->setOrientation('landscape')
            // ->setOption('footer-html',utf8_decode($footer))
            ->setOption('margin-top', 20)
            ->setOption('margin-bottom',3)
            ->setOption('margin-left',20)
            ->setOption('margin-right',20);

        return $pdf->inline('Despacho '.$solicitud->id. '_'. time().'.pdf');


    }

    public function stock(StockDataTable $dataTable,Request $request)
    {
        $renglon = $request->renglon ?? null;
        $bodega_id = $request->bodega_id ?? null;
        $buscar = $request->buscar ?? null;
        $stock = $request->stock ?? null;

        $query = Stock::with(['item']);


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

        $stocks = $query->conIngresos()->get();

        return view('reportes.stock.index_old',compact('stocks','renglon','bodega_id','stock','buscar'));

    }

    public function itemsAvencer(ItemsAvencerDataTable $dataTable,Request $request)
    {

        $scope = new ScopeStockDataTable();

        $dataTable->addScope($scope);

        return $dataTable->render('items.reportes.proximos_a_vencer');

    }
}
