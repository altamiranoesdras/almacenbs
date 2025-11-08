<?php

namespace App\Http\Controllers;

use App\DataTables\FinanciamientoFuenteDataTable;
use App\Http\Requests\CreateFinanciamientoFuenteRequest;
use App\Http\Requests\UpdateFinanciamientoFuenteRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\FinanciamientoFuente;
use Illuminate\Http\Request;

class FinanciamientoFuenteController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Financiamiento Fuentes')->only('show');
        $this->middleware('permission:Crear Financiamiento Fuentes')->only(['create','store']);
        $this->middleware('permission:Editar Financiamiento Fuentes')->only(['edit','update']);
        $this->middleware('permission:Eliminar Financiamiento Fuentes')->only('destroy');
    }
    /**
     * Display a listing of the FinanciamientoFuente.
     */
    public function index(FinanciamientoFuenteDataTable $financiamientoFuenteDataTable)
    {
    return $financiamientoFuenteDataTable->render('financiamiento_fuentes.index');
    }


    /**
     * Show the form for creating a new FinanciamientoFuente.
     */
    public function create()
    {
        return view('financiamiento_fuentes.create');
    }

    /**
     * Store a newly created FinanciamientoFuente in storage.
     */
    public function store(CreateFinanciamientoFuenteRequest $request)
    {
        $input = $request->all();

        /** @var FinanciamientoFuente $financiamientoFuente */
        $financiamientoFuente = FinanciamientoFuente::create($input);

        flash()->success('Financiamiento Fuente guardado.');

        return redirect(route('financiamientoFuentes.index'));
    }

    /**
     * Display the specified FinanciamientoFuente.
     */
    public function show($id)
    {
        /** @var FinanciamientoFuente $financiamientoFuente */
        $financiamientoFuente = FinanciamientoFuente::find($id);

        if (empty($financiamientoFuente)) {
            flash()->error('Financiamiento Fuente no encontrado');

            return redirect(route('financiamientoFuentes.index'));
        }

        return view('financiamiento_fuentes.show')->with('financiamientoFuente', $financiamientoFuente);
    }

    /**
     * Show the form for editing the specified FinanciamientoFuente.
     */
    public function edit($id)
    {
        /** @var FinanciamientoFuente $financiamientoFuente */
        $financiamientoFuente = FinanciamientoFuente::find($id);

        if (empty($financiamientoFuente)) {
            flash()->error('Financiamiento Fuente no encontrado');

            return redirect(route('financiamientoFuentes.index'));
        }

        return view('financiamiento_fuentes.edit')->with('financiamientoFuente', $financiamientoFuente);
    }

    /**
     * Update the specified FinanciamientoFuente in storage.
     */
    public function update($id, UpdateFinanciamientoFuenteRequest $request)
    {
        /** @var FinanciamientoFuente $financiamientoFuente */
        $financiamientoFuente = FinanciamientoFuente::find($id);

        if (empty($financiamientoFuente)) {
            flash()->error('Financiamiento Fuente no encontrado');

            return redirect(route('financiamientoFuentes.index'));
        }

        $financiamientoFuente->fill($request->all());
        $financiamientoFuente->save();

        flash()->success('Financiamiento Fuente actualizado.');

        return redirect(route('financiamientoFuentes.index'));
    }

    /**
     * Remove the specified FinanciamientoFuente from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var FinanciamientoFuente $financiamientoFuente */
        $financiamientoFuente = FinanciamientoFuente::find($id);

        if (empty($financiamientoFuente)) {
            flash()->error('Financiamiento Fuente no encontrado');

            return redirect(route('financiamientoFuentes.index'));
        }

        $financiamientoFuente->delete();

        flash()->success('Financiamiento Fuente eliminado.');

        return redirect(route('financiamientoFuentes.index'));
    }
}
