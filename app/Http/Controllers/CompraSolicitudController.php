<?php

namespace App\Http\Controllers;

use App\DataTables\CompraSolicitudDataTable;
use App\Http\Requests\CreateCompraSolicitudRequest;
use App\Http\Requests\UpdateCompraSolicitudRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CompraSolicitud;
use Illuminate\Http\Request;

class CompraSolicitudController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Solicituds')->only('show');
        $this->middleware('permission:Crear Compra Solicituds')->only(['create','store']);
        $this->middleware('permission:Editar Compra Solicituds')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Solicituds')->only('destroy');
    }
    /**
     * Display a listing of the CompraSolicitud.
     */
    public function index(CompraSolicitudDataTable $compraSolicitudDataTable)
    {
    return $compraSolicitudDataTable->render('compra_solicitudes.index');
    }


    /**
     * Show the form for creating a new CompraSolicitud.
     */
    public function create()
    {
        return view('compra_solicitudes.create');
    }

    /**
     * Store a newly created CompraSolicitud in storage.
     */
    public function store(CreateCompraSolicitudRequest $request)
    {
        $input = $request->all();

        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::create($input);

        flash()->success('Compra Solicitud guardado.');

        return redirect(route('compraSolicitudes.index'));
    }

    /**
     * Display the specified CompraSolicitud.
     */
    public function show($id)
    {
        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::find($id);

        if (empty($compraSolicitud)) {
            flash()->error('Compra Solicitud no encontrado');

            return redirect(route('compraSolicitudes.index'));
        }

        return view('compra_solicitudes.show')->with('compraSolicitud', $compraSolicitud);
    }

    /**
     * Show the form for editing the specified CompraSolicitud.
     */
    public function edit($id)
    {
        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::find($id);

        if (empty($compraSolicitud)) {
            flash()->error('Compra Solicitud no encontrado');

            return redirect(route('compraSolicitudes.index'));
        }

        return view('compra_solicitudes.edit')->with('compraSolicitud', $compraSolicitud);
    }

    /**
     * Update the specified CompraSolicitud in storage.
     */
    public function update($id, UpdateCompraSolicitudRequest $request)
    {
        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::find($id);

        if (empty($compraSolicitud)) {
            flash()->error('Compra Solicitud no encontrado');

            return redirect(route('compraSolicitudes.index'));
        }

        $compraSolicitud->fill($request->all());
        $compraSolicitud->save();

        flash()->success('Compra Solicitud actualizado.');

        return redirect(route('compraSolicitudes.index'));
    }

    /**
     * Remove the specified CompraSolicitud from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraSolicitud $compraSolicitud */
        $compraSolicitud = CompraSolicitud::find($id);

        if (empty($compraSolicitud)) {
            flash()->error('Compra Solicitud no encontrado');

            return redirect(route('compraSolicitudes.index'));
        }

        $compraSolicitud->delete();

        flash()->success('Compra Solicitud eliminado.');

        return redirect(route('compraSolicitudes.index'));
    }
}
