<?php

namespace App\Http\Controllers;

use App\DataTables\KardexDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateKardexRequest;
use App\Http\Requests\UpdateKardexRequest;
use App\Models\Kardex;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class KardexController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Kardexs')->only(['show']);
        $this->middleware('permission:Crear Kardexs')->only(['create','store']);
        $this->middleware('permission:Editar Kardexs')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Kardexs')->only(['destroy']);
    }

    /**
     * Display a listing of the Kardex.
     *
     * @param KardexDataTable $kardexDataTable
     * @return Response
     */
    public function index(KardexDataTable $kardexDataTable)
    {
        return $kardexDataTable->render('kardexes.index');
    }

    /**
     * Show the form for creating a new Kardex.
     *
     * @return Response
     */
    public function create()
    {
        return view('kardexes.create');
    }

    /**
     * Store a newly created Kardex in storage.
     *
     * @param CreateKardexRequest $request
     *
     * @return Response
     */
    public function store(CreateKardexRequest $request)
    {
        $input = $request->all();

        /** @var Kardex $kardex */
        $kardex = Kardex::create($input);

        Flash::success('Kardex guardado exitosamente.');

        return redirect(route('kardexes.index'));
    }

    /**
     * Display the specified Kardex.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Kardex $kardex */
        $kardex = Kardex::find($id);

        if (empty($kardex)) {
            Flash::error('Kardex no encontrado');

            return redirect(route('kardexes.index'));
        }

        return view('kardexes.show')->with('kardex', $kardex);
    }

    /**
     * Show the form for editing the specified Kardex.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Kardex $kardex */
        $kardex = Kardex::find($id);

        if (empty($kardex)) {
            Flash::error('Kardex no encontrado');

            return redirect(route('kardexes.index'));
        }

        return view('kardexes.edit')->with('kardex', $kardex);
    }

    /**
     * Update the specified Kardex in storage.
     *
     * @param  int              $id
     * @param UpdateKardexRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKardexRequest $request)
    {
        /** @var Kardex $kardex */
        $kardex = Kardex::find($id);

        if (empty($kardex)) {
            Flash::error('Kardex no encontrado');

            return redirect(route('kardexes.index'));
        }

        $kardex->fill($request->all());
        $kardex->save();

        Flash::success('Kardex actualizado con éxito.');

        return redirect(route('kardexes.index'));
    }

    /**
     * Remove the specified Kardex from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Kardex $kardex */
        $kardex = Kardex::find($id);

        if (empty($kardex)) {
            Flash::error('Kardex no encontrado');

            return redirect(route('kardexes.index'));
        }

        $kardex->delete();

        Flash::success('Kardex deleted successfully.');

        return redirect(route('kardexes.index'));
    }
}
