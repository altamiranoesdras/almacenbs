<?php

namespace App\Http\Controllers;

use App\DataTables\StockDataTable;
use App\Models\Kardex;
use App\VistaStock;
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

        return $dataTable->render('reportes.stock.index');

    }
}
