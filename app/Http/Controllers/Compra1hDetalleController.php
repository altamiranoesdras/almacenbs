<?php

namespace App\Http\Controllers;

use App\DataTables\Compra1hDetalleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCompra1hDetalleRequest;
use App\Http\Requests\UpdateCompra1hDetalleRequest;
use App\Models\Compra1hDetalle;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Compra1hDetalleController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra1H Detalles')->only(['show']);
        $this->middleware('permission:Crear Compra1H Detalles')->only(['create','store']);
        $this->middleware('permission:Editar Compra1H Detalles')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Compra1H Detalles')->only(['destroy']);
    }

    /**
     * Display a listing of the Compra1hDetalle.
     *
     * @param Compra1hDetalleDataTable $compra1hDetalleDataTable
     * @return Response
     */
    public function index(Compra1hDetalleDataTable $compra1hDetalleDataTable)
    {
        return $compra1hDetalleDataTable->render('compra1h_detalles.index');
    }

    /**
     * Show the form for creating a new Compra1hDetalle.
     *
     * @return Response
     */
    public function create()
    {
        return view('compra1h_detalles.create');
    }

    /**
     * Store a newly created Compra1hDetalle in storage.
     *
     * @param CreateCompra1hDetalleRequest $request
     *
     * @return Response
     */
    public function store(CreateCompra1hDetalleRequest $request)
    {
        $input = $request->all();

        /** @var Compra1hDetalle $compra1hDetalle */
        $compra1hDetalle = Compra1hDetalle::create($input);

        Flash::success('Compra1H Detalle guardado exitosamente.');

        return redirect(route('compra1hDetalles.index'));
    }

    /**
     * Display the specified Compra1hDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Compra1hDetalle $compra1hDetalle */
        $compra1hDetalle = Compra1hDetalle::find($id);

        if (empty($compra1hDetalle)) {
            Flash::error('Compra1H Detalle no encontrado');

            return redirect(route('compra1hDetalles.index'));
        }

        return view('compra1h_detalles.show')->with('compra1hDetalle', $compra1hDetalle);
    }

    /**
     * Show the form for editing the specified Compra1hDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Compra1hDetalle $compra1hDetalle */
        $compra1hDetalle = Compra1hDetalle::find($id);

        if (empty($compra1hDetalle)) {
            Flash::error('Compra1H Detalle no encontrado');

            return redirect(route('compra1hDetalles.index'));
        }

        return view('compra1h_detalles.edit')->with('compra1hDetalle', $compra1hDetalle);
    }

    /**
     * Update the specified Compra1hDetalle in storage.
     *
     * @param  int              $id
     * @param UpdateCompra1hDetalleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompra1hDetalleRequest $request)
    {
        /** @var Compra1hDetalle $compra1hDetalle */
        $compra1hDetalle = Compra1hDetalle::find($id);

        if (empty($compra1hDetalle)) {
            Flash::error('Compra1H Detalle no encontrado');

            return redirect(route('compra1hDetalles.index'));
        }

        $compra1hDetalle->fill($request->all());
        $compra1hDetalle->save();

        Flash::success('Compra1H Detalle actualizado con éxito.');

        return redirect(route('compra1hDetalles.index'));
    }

    /**
     * Remove the specified Compra1hDetalle from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Compra1hDetalle $compra1hDetalle */
        $compra1hDetalle = Compra1hDetalle::find($id);

        if (empty($compra1hDetalle)) {
            Flash::error('Compra1H Detalle no encontrado');

            return redirect(route('compra1hDetalles.index'));
        }

        $compra1hDetalle->delete();

        Flash::success('Compra1H Detalle deleted successfully.');

        return redirect(route('compra1hDetalles.index'));
    }
}
