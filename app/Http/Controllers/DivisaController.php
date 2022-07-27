<?php

namespace App\Http\Controllers;

use App\DataTables\DivisaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDivisaRequest;
use App\Http\Requests\UpdateDivisaRequest;
use App\Models\Divisa;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DivisaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Divisas')->only(['show']);
        $this->middleware('permission:Crear Divisas')->only(['create','store']);
        $this->middleware('permission:Editar Divisas')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Divisas')->only(['destroy']);
    }

    /**
     * Display a listing of the Divisa.
     *
     * @param DivisaDataTable $divisaDataTable
     * @return Response
     */
    public function index(DivisaDataTable $divisaDataTable)
    {
        return $divisaDataTable->render('divisas.index');
    }

    /**
     * Show the form for creating a new Divisa.
     *
     * @return Response
     */
    public function create()
    {
        return view('divisas.create');
    }

    /**
     * Store a newly created Divisa in storage.
     *
     * @param CreateDivisaRequest $request
     *
     * @return Response
     */
    public function store(CreateDivisaRequest $request)
    {
        $input = $request->all();

        /** @var Divisa $divisa */
        $divisa = Divisa::create($input);

        Flash::success('Divisa guardado exitosamente.');

        return redirect(route('divisas.index'));
    }

    /**
     * Display the specified Divisa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Divisa $divisa */
        $divisa = Divisa::find($id);

        if (empty($divisa)) {
            Flash::error('Divisa no encontrado');

            return redirect(route('divisas.index'));
        }

        return view('divisas.show')->with('divisa', $divisa);
    }

    /**
     * Show the form for editing the specified Divisa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Divisa $divisa */
        $divisa = Divisa::find($id);

        if (empty($divisa)) {
            Flash::error('Divisa no encontrado');

            return redirect(route('divisas.index'));
        }

        return view('divisas.edit')->with('divisa', $divisa);
    }

    /**
     * Update the specified Divisa in storage.
     *
     * @param  int              $id
     * @param UpdateDivisaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDivisaRequest $request)
    {
        /** @var Divisa $divisa */
        $divisa = Divisa::find($id);

        if (empty($divisa)) {
            Flash::error('Divisa no encontrado');

            return redirect(route('divisas.index'));
        }

        $divisa->fill($request->all());
        $divisa->save();

        Flash::success('Divisa actualizado con éxito.');

        return redirect(route('divisas.index'));
    }

    /**
     * Remove the specified Divisa from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Divisa $divisa */
        $divisa = Divisa::find($id);

        if (empty($divisa)) {
            Flash::error('Divisa no encontrado');

            return redirect(route('divisas.index'));
        }

        $divisa->delete();

        Flash::success('Divisa deleted successfully.');

        return redirect(route('divisas.index'));
    }
}
