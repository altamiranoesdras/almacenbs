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

        list($mes,$anio) = explode("-", $request->get('mes'));

        return view('reportes.libro_almacen.libro_almacen',compact('mes','anio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf(Request $request)
    {

        list($mes,$anio) = explode("-", $request->get('mes'));

        $listadoCompras = Compra::with(['proveedor','detalles.item'])
            ->where('estado_id', CompraEstado::RECIBIDA)
            ->whereMonth('fecha_documento', '=', $mes)
            ->whereYear('fecha_documento', '=', $anio)
            ->get();

//            return $listadoCompras;

        $pdf = App::make('snappy.pdf.wrapper');

        $view = view('reportes.libro_almacen.pdf', compact('request','listadoCompras'))->render();

        $pdf->loadHTML($view)
//            ->setOption('page-width', '220')
//            ->setOption('page-height', '280')
            ->setOrientation('landscape')
            // ->setOption('footer-html',utf8_decode($footer))
            ->setOption('margin-top', 30)
            ->setOption('margin-bottom',20)
            ->setOption('margin-left',15)
            ->setOption('margin-right',15);
        // ->stream('report.pdf');

        return $pdf->inline('Libro almacen '.mesLetras($mes).' '.$anio.' .pdf');
    }


}
