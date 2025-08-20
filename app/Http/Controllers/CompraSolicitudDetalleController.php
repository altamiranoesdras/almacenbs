<?php

namespace App\Http\Controllers;

use App\DataTables\CompraSolicitudDetalleDataTable;
use App\Http\Requests\CreateCompraSolicitudDetalleRequest;
use App\Http\Requests\UpdateCompraSolicitudDetalleRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CompraSolicitudDetalle;
use Illuminate\Http\Request;

class CompraSolicitudDetalleController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Solicitud Detalles')->only('show');
        $this->middleware('permission:Crear Compra Solicitud Detalles')->only(['create','store']);
        $this->middleware('permission:Editar Compra Solicitud Detalles')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Solicitud Detalles')->only('destroy');
    }
    /**
     * Display a listing of the CompraSolicitudDetalle.
     */
    public function index(CompraSolicitudDetalleDataTable $compraSolicitudDetalleDataTable)
    {
    return $compraSolicitudDetalleDataTable->render('compra_solicitud_detalles.index');
    }


    /**
     * Show the form for creating a new CompraSolicitudDetalle.
     */
    public function create()
    {
        return view('compra_solicitud_detalles.create');
    }

    /**
     * Store a newly created CompraSolicitudDetalle in storage.
     */
    public function store(CreateCompraSolicitudDetalleRequest $request)
    {
        $input = $request->all();

        /** @var CompraSolicitudDetalle $compraSolicitudDetalle */
        $compraSolicitudDetalle = CompraSolicitudDetalle::create($input);

        flash()->success('Compra Solicitud Detalle guardado.');

        return redirect(route('compraSolicitudDetalles.index'));
    }

    /**
     * Display the specified CompraSolicitudDetalle.
     */
    public function show($id)
    {
        /** @var CompraSolicitudDetalle $compraSolicitudDetalle */
        $compraSolicitudDetalle = CompraSolicitudDetalle::find($id);

        if (empty($compraSolicitudDetalle)) {
            flash()->error('Compra Solicitud Detalle no encontrado');

            return redirect(route('compraSolicitudDetalles.index'));
        }

        return view('compra_solicitud_detalles.show')->with('compraSolicitudDetalle', $compraSolicitudDetalle);
    }

    /**
     * Show the form for editing the specified CompraSolicitudDetalle.
     */
    public function edit($id)
    {
        /** @var CompraSolicitudDetalle $compraSolicitudDetalle */
        $compraSolicitudDetalle = CompraSolicitudDetalle::find($id);

        if (empty($compraSolicitudDetalle)) {
            flash()->error('Compra Solicitud Detalle no encontrado');

            return redirect(route('compraSolicitudDetalles.index'));
        }

        return view('compra_solicitud_detalles.edit')->with('compraSolicitudDetalle', $compraSolicitudDetalle);
    }

    /**
     * Update the specified CompraSolicitudDetalle in storage.
     */
    public function update($id, UpdateCompraSolicitudDetalleRequest $request)
    {
        /** @var CompraSolicitudDetalle $compraSolicitudDetalle */
        $compraSolicitudDetalle = CompraSolicitudDetalle::find($id);

        if (empty($compraSolicitudDetalle)) {
            flash()->error('Compra Solicitud Detalle no encontrado');

            return redirect(route('compraSolicitudDetalles.index'));
        }

        $compraSolicitudDetalle->fill($request->all());
        $compraSolicitudDetalle->save();

        flash()->success('Compra Solicitud Detalle actualizado.');

        return redirect(route('compraSolicitudDetalles.index'));
    }

    /**
     * Remove the specified CompraSolicitudDetalle from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraSolicitudDetalle $compraSolicitudDetalle */
        $compraSolicitudDetalle = CompraSolicitudDetalle::find($id);

        if (empty($compraSolicitudDetalle)) {
            flash()->error('Compra Solicitud Detalle no encontrado');

            return redirect(route('compraSolicitudDetalles.index'));
        }

        $compraSolicitudDetalle->delete();

        flash()->success('Compra Solicitud Detalle eliminado.');

        return redirect(route('compraSolicitudDetalles.index'));
    }
}
