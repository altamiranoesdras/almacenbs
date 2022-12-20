<?php

namespace App\Http\Controllers;

use App\DataTables\BodegaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBodegaRequest;
use App\Http\Requests\UpdateBodegaRequest;
use App\Models\Bodega;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class BodegaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Bodegas')->only(['show']);
        $this->middleware('permission:Crear Bodegas')->only(['create','store']);
        $this->middleware('permission:Editar Bodegas')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Bodegas')->only(['destroy']);
    }

    /**
     * Display a listing of the Bodega.
     *
     * @param BodegaDataTable $bodegaDataTable
     * @return Response
     */
    public function index(BodegaDataTable $bodegaDataTable)
    {
        return $bodegaDataTable->render('bodegas.index');
    }

    /**
     * Show the form for creating a new Bodega.
     *
     * @return Response
     */
    public function create()
    {
        return view('bodegas.create');
    }

    /**
     * Store a newly created Bodega in storage.
     *
     * @param CreateBodegaRequest $request
     *
     * @return Response
     */
    public function store(CreateBodegaRequest $request)
    {
        $input = $request->all();

        /** @var Bodega $bodega */
        $bodega = Bodega::create($input);

        Flash::success('Bodega guardado exitosamente.');

        return redirect(route('bodegas.index'));
    }

    /**
     * Display the specified Bodega.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Bodega $bodega */
        $bodega = Bodega::find($id);

        if (empty($bodega)) {
            Flash::error('Bodega no encontrado');

            return redirect(route('bodegas.index'));
        }

        return view('bodegas.show')->with('bodega', $bodega);
    }

    /**
     * Show the form for editing the specified Bodega.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Bodega $bodega */
        $bodega = Bodega::find($id);

        if (empty($bodega)) {
            Flash::error('Bodega no encontrado');

            return redirect(route('bodegas.index'));
        }

        return view('bodegas.edit')->with('bodega', $bodega);
    }

    /**
     * Update the specified Bodega in storage.
     *
     * @param  int              $id
     * @param UpdateBodegaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBodegaRequest $request)
    {
        /** @var Bodega $bodega */
        $bodega = Bodega::find($id);

        if (empty($bodega)) {
            Flash::error('Bodega no encontrado');

            return redirect(route('bodegas.index'));
        }

        $bodega->fill($request->all());
        $bodega->save();

        Flash::success('Bodega actualizado con éxito.');

        return redirect(route('bodegas.index'));
    }

    /**
     * Remove the specified Bodega from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Bodega $bodega */
        $bodega = Bodega::find($id);

        if (empty($bodega)) {
            Flash::error('Bodega no encontrado');

            return redirect(route('bodegas.index'));
        }

        $bodega->delete();

        Flash::success('Bodega deleted successfully.');

        return redirect(route('bodegas.index'));
    }
}
