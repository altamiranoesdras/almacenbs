<?php

namespace App\Http\Controllers;

use App\DataTables\RrhhContratoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRrhhContratoRequest;
use App\Http\Requests\UpdateRrhhContratoRequest;
use App\Models\RrhhContrato;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class RrhhContratoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Rrhh Contratos')->only(['show']);
        $this->middleware('permission:Crear Rrhh Contratos')->only(['create','store']);
        $this->middleware('permission:Editar Rrhh Contratos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Rrhh Contratos')->only(['destroy']);
    }

    /**
     * Display a listing of the RrhhContrato.
     *
     * @param RrhhContratoDataTable $rrhhContratoDataTable
     * @return Response
     */
    public function index(RrhhContratoDataTable $rrhhContratoDataTable)
    {
        return $rrhhContratoDataTable->render('rrhh_contratos.index');
    }

    /**
     * Show the form for creating a new RrhhContrato.
     *
     * @return Response
     */
    public function create()
    {
        return view('rrhh_contratos.create');
    }

    /**
     * Store a newly created RrhhContrato in storage.
     *
     * @param CreateRrhhContratoRequest $request
     *
     * @return Response
     */
    public function store(CreateRrhhContratoRequest $request)
    {
        $input = $request->all();

        /** @var RrhhContrato $rrhhContrato */
        $rrhhContrato = RrhhContrato::create($input);

        Flash::success('Rrhh Contrato guardado exitosamente.');

        return redirect(route('rrhhContratos.index'));
    }

    /**
     * Display the specified RrhhContrato.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RrhhContrato $rrhhContrato */
        $rrhhContrato = RrhhContrato::find($id);

        if (empty($rrhhContrato)) {
            Flash::error('Rrhh Contrato no encontrado');

            return redirect(route('rrhhContratos.index'));
        }

        return view('rrhh_contratos.show')->with('rrhhContrato', $rrhhContrato);
    }

    /**
     * Show the form for editing the specified RrhhContrato.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var RrhhContrato $rrhhContrato */
        $rrhhContrato = RrhhContrato::find($id);

        if (empty($rrhhContrato)) {
            Flash::error('Rrhh Contrato no encontrado');

            return redirect(route('rrhhContratos.index'));
        }

        return view('rrhh_contratos.edit')->with('rrhhContrato', $rrhhContrato);
    }

    /**
     * Update the specified RrhhContrato in storage.
     *
     * @param  int              $id
     * @param UpdateRrhhContratoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRrhhContratoRequest $request)
    {
        /** @var RrhhContrato $rrhhContrato */
        $rrhhContrato = RrhhContrato::find($id);

        if (empty($rrhhContrato)) {
            Flash::error('Rrhh Contrato no encontrado');

            return redirect(route('rrhhContratos.index'));
        }

        $rrhhContrato->fill($request->all());
        $rrhhContrato->save();

        Flash::success('Rrhh Contrato actualizado con éxito.');

        return redirect(route('rrhhContratos.index'));
    }

    /**
     * Remove the specified RrhhContrato from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RrhhContrato $rrhhContrato */
        $rrhhContrato = RrhhContrato::find($id);

        if (empty($rrhhContrato)) {
            Flash::error('Rrhh Contrato no encontrado');

            return redirect(route('rrhhContratos.index'));
        }

        $rrhhContrato->delete();

        Flash::success('Rrhh Contrato deleted successfully.');

        return redirect(route('rrhhContratos.index'));
    }
}
