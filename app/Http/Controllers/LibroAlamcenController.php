<?php

namespace App\Http\Controllers;

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

        if ($request->get('buscar')) {

            $pdf = App::make('snappy.pdf.wrapper');

            $view = view('reportes.libro_almacen.pdf', compact('request'))->render();

            $pdf->loadHTML($view)
//            ->setOption('page-width', '220')
//            ->setOption('page-height', '280')
                ->setOrientation('landscape')
                // ->setOption('footer-html',utf8_decode($footer))
                ->setOption('margin-top', 10)
                ->setOption('margin-bottom',3)
                ->setOption('margin-left',10)
                ->setOption('margin-right',10);
            // ->stream('report.pdf');

            return $pdf->inline('CompraH1-'.time().'.pdf');
        }

        return view('reportes.libro_almacen.libro_almacen');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
