<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\CompraEstado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LibroAlamcenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $mes = null;
        $anio = null;
        if ($request->fecha){
            list($anio,$mes) = explode("-", $request->fecha);
        }


        return view('reportes.libro_almacen.libro_almacen',compact('mes','anio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf(Request $request)
    {

        list($anio,$mes) = explode("-", $request->get('mes'));


        $listadoCompras = Compra::with([
                'proveedor',
                'detalles' => function($queryDetalles){
                    $queryDetalles->with('item')->whereHas('item');
                }
            ])
            ->whereHas('detalles',function ($queryDetalles){
                $queryDetalles->whereHas('item');
            })
            ->where('estado_id', CompraEstado::RECIBIDA)
            ->whereMonth('fecha_documento', '=', $mes)
            ->whereYear('fecha_documento', '=', $anio)
            ->get();

//            return $listadoCompras;

        $pdf = App::make('snappy.pdf.wrapper');

        $view = view('reportes.libro_almacen.pdf', compact('request','listadoCompras'))->render();

        $pdf->loadHTML($view)
           ->setOption('page-width', 216)
           ->setOption('page-height', 279)
            ->setOrientation('landscape')
            // ->setOption('footer-html',utf8_decode($footer))
            ->setOption('margin-top', 46)
            ->setOption('margin-bottom',0)
            ->setOption('margin-left',15)
            ->setOption('margin-right',15)
            ->stream('report.pdf')
            ;

        return $pdf->inline('Libro almacen '.mesLetras($mes).' '.$anio.' .pdf');
    }


}
