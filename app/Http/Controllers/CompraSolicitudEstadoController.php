<?php

namespace App\Http\Controllers;

use App\DataTables\CompraSolicitudEstadoDataTable;
use App\Http\Requests\CreateCompraSolicitudEstadoRequest;
use App\Http\Requests\UpdateCompraSolicitudEstadoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CompraSolicitudEstado;
use Illuminate\Http\Request;

class CompraSolicitudEstadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Compra Solicitud Estados')->only('show');
        $this->middleware('permission:Crear Compra Solicitud Estados')->only(['create','store']);
        $this->middleware('permission:Editar Compra Solicitud Estados')->only(['edit','update']);
        $this->middleware('permission:Eliminar Compra Solicitud Estados')->only('destroy');
    }
    /**
     * Display a listing of the CompraSolicitudEstado.
     */
    public function index(CompraSolicitudEstadoDataTable $compraSolicitudEstadoDataTable)
    {
    return $compraSolicitudEstadoDataTable->render('compra_solicitud_estados.index');
    }


    /**
     * Show the form for creating a new CompraSolicitudEstado.
     */
    public function create()
    {
        return view('compra_solicitud_estados.create');
    }

    /**
     * Store a newly created CompraSolicitudEstado in storage.
     */
    public function store(CreateCompraSolicitudEstadoRequest $request)
    {
        $input = $request->all();

        /** @var CompraSolicitudEstado $compraSolicitudEstado */
        $compraSolicitudEstado = CompraSolicitudEstado::create($input);

        flash()->success('Compra Solicitud Estado guardado.');

        return redirect(route('compraSolicitudEstados.index'));
    }

    /**
     * Display the specified CompraSolicitudEstado.
     */
    public function show($id)
    {
        /** @var CompraSolicitudEstado $compraSolicitudEstado */
        $compraSolicitudEstado = CompraSolicitudEstado::find($id);

        if (empty($compraSolicitudEstado)) {
            flash()->error('Compra Solicitud Estado no encontrado');

            return redirect(route('compraSolicitudEstados.index'));
        }

        return view('compra_solicitud_estados.show')->with('compraSolicitudEstado', $compraSolicitudEstado);
    }

    /**
     * Show the form for editing the specified CompraSolicitudEstado.
     */
    public function edit($id)
    {
        /** @var CompraSolicitudEstado $compraSolicitudEstado */
        $compraSolicitudEstado = CompraSolicitudEstado::find($id);

        if (empty($compraSolicitudEstado)) {
            flash()->error('Compra Solicitud Estado no encontrado');

            return redirect(route('compraSolicitudEstados.index'));
        }

        return view('compra_solicitud_estados.edit')->with('compraSolicitudEstado', $compraSolicitudEstado);
    }

    /**
     * Update the specified CompraSolicitudEstado in storage.
     */
    public function update($id, UpdateCompraSolicitudEstadoRequest $request)
    {
        /** @var CompraSolicitudEstado $compraSolicitudEstado */
        $compraSolicitudEstado = CompraSolicitudEstado::find($id);

        if (empty($compraSolicitudEstado)) {
            flash()->error('Compra Solicitud Estado no encontrado');

            return redirect(route('compraSolicitudEstados.index'));
        }

        $compraSolicitudEstado->fill($request->all());
        $compraSolicitudEstado->save();

        flash()->success('Compra Solicitud Estado actualizado.');

        return redirect(route('compraSolicitudEstados.index'));
    }

    /**
     * Remove the specified CompraSolicitudEstado from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CompraSolicitudEstado $compraSolicitudEstado */
        $compraSolicitudEstado = CompraSolicitudEstado::find($id);

        if (empty($compraSolicitudEstado)) {
            flash()->error('Compra Solicitud Estado no encontrado');

            return redirect(route('compraSolicitudEstados.index'));
        }

        $compraSolicitudEstado->delete();

        flash()->success('Compra Solicitud Estado eliminado.');

        return redirect(route('compraSolicitudEstados.index'));
    }
}
