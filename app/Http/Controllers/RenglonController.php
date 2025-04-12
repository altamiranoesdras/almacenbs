<?php

namespace App\Http\Controllers;

use App\DataTables\RenglonDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRenglonRequest;
use App\Http\Requests\UpdateRenglonRequest;
use App\Models\Renglon;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class RenglonController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Renglons')->only(['show']);
        $this->middleware('permission:Crear Renglons')->only(['create','store']);
        $this->middleware('permission:Editar Renglons')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Renglons')->only(['destroy']);
    }

    /**
     * Display a listing of the Renglon.
     *
     * @param RenglonDataTable $renglonDataTable
     * @return Response
     */
    public function index(RenglonDataTable $renglonDataTable)
    {
        return $renglonDataTable->render('renglones.index');
    }

    /**
     * Show the form for creating a new Renglon.
     *
     * @return Response
     */
    public function create()
    {
        return view('renglones.create');
    }

    /**
     * Store a newly created Renglon in storage.
     *
     * @param CreateRenglonRequest $request
     *
     * @return Response
     */
    public function store(CreateRenglonRequest $request)
    {
        $input = $request->all();

        /** @var Renglon $renglon */
        $renglon = Renglon::create($input);

        Flash::success('Renglon guardado exitosamente.');

        return redirect(route('renglones.index'));
    }

    /**
     * Display the specified Renglon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Renglon $renglon */
        $renglon = Renglon::find($id);

        if (empty($renglon)) {
            Flash::error('Renglon no encontrado');

            return redirect(route('renglones.index'));
        }

        return view('renglones.show')->with('renglon', $renglon);
    }

    /**
     * Show the form for editing the specified Renglon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Renglon $renglon */
        $renglon = Renglon::find($id);

        if (empty($renglon)) {
            Flash::error('Renglon no encontrado');

            return redirect(route('renglones.index'));
        }

        return view('renglones.edit')->with('renglon', $renglon);
    }

    /**
     * Update the specified Renglon in storage.
     *
     * @param  int              $id
     * @param UpdateRenglonRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRenglonRequest $request)
    {
        /** @var Renglon $renglon */
        $renglon = Renglon::find($id);

        if (empty($renglon)) {
            Flash::error('Renglon no encontrado');

            return redirect(route('renglones.index'));
        }

        $renglon->fill($request->all());
        $renglon->save();

        Flash::success('Renglon actualizado con éxito.');

        return redirect(route('renglones.index'));
    }

    /**
     * Remove the specified Renglon from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Renglon $renglon */
        $renglon = Renglon::find($id);

        if (empty($renglon)) {
            Flash::error('Renglon no encontrado');

            return redirect(route('renglones.index'));
        }

        $renglon->delete();

        Flash::success('Renglon deleted successfully.');

        return redirect(route('renglones.index'));
    }
}
