<?php

namespace App\Http\Controllers;

use App\DataTables\StockDataTable;
use App\Models\Kardex;
use App\Models\Stock;
use App\VistaStock;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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


        $kardex = Kardex::delItem($item_id)
            ->orderBy('created_at','asc')
            ->get();


        return view('reportes.kardex_por_item',compact('kardex','item_id','buscar','saldo'));
    }

    public function stock(StockDataTable $dataTable,Request $request)
    {
        $renglon = $request->renglon ?? null;
        $buscar = $request->buscar ?? null;
        $stock = $request->stock ?? null;

        $stocks = Stock::with(['item']);


        if ($renglon){
            $stocks = $stocks->whereHas('item',function (Builder $q) use ($renglon){
                $q->where('renglon_id',$renglon);
            });
        }

        if ($stock=="con_stock"){
            $stocks = $stocks->where('cantidad','!=','0');
        }


        if ($stock=="sin_stock"){

            $stocks = $stocks->where('cantidad','0');
        }

        $stocks = $stocks->get();

        return view('reportes.stock.index_old',compact('stocks','renglon','stock','buscar'));

    }
}
