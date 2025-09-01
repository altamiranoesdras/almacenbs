<?php

namespace App\Http\Controllers;

use App\DataTables\CompraAprobarDataTable;
use App\DataTables\CompraOperarDataTable;
use App\DataTables\Scopes\ScopeCompraDataTable;
use App\Models\Compra;
use App\Models\CompraEstado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Compra1hOperadorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CompraOperarDataTable $dataTable)
    {

        $scoper = new ScopeCompraDataTable();
        $scoper->estados = [CompraEstado::INGRESADO];

        $dataTable->addScope($scoper);

        return $dataTable->render('compras.operar.index');
    }

    public function gestionar(Compra $compra)
    {
        return view('compras.operar.gestionar', compact('compra'));
    }

    public function genera1h(Compra $compra)
    {
        try {
            DB::beginTransaction();

            $compra->genera1h(request()->folio);
            $compra->addBitacora('Formulario 1H generado');

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


    public function procesar(Compra $compra)
    {


    }
}
