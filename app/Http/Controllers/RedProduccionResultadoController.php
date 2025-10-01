<?php

namespace App\Http\Controllers;

use App\DataTables\RedProduccionResultadoDataTable;
use App\Http\Requests\CreateRedProduccionResultadoRequest;
use App\Http\Requests\UpdateRedProduccionResultadoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\RedProduccionResultado;
use Illuminate\Http\Request;

class RedProduccionResultadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Red Producción Resultados')->only('show');
        $this->middleware('permission:Crear Red Producción Resultados')->only(['create','store']);
        $this->middleware('permission:Editar Red Producción Resultados')->only(['edit','update']);
        $this->middleware('permission:Eliminar Red Producción Resultados')->only('destroy');
    }
    /**
     * Display a listing of the RedProduccionResultado.
     */
    public function index(RedProduccionResultadoDataTable $redProduccionResultadoDataTable)
    {
    return $redProduccionResultadoDataTable->render('red_produccion_resultados.index');
    }


    /**
     * Show the form for creating a new RedProduccionResultado.
     */
    public function create()
    {
        return view('red_produccion_resultados.create');
    }

    /**
     * Store a newly created RedProduccionResultado in storage.
     */
    public function store(CreateRedProduccionResultadoRequest $request)
    {
        $input = $request->all();

        /** @var RedProduccionResultado $redProduccionResultado */
        $redProduccionResultado = RedProduccionResultado::create($input);

        flash()->success('Red Producción Resultado guardado.');

        return redirect(route('red-produccion.resultados.index'));
    }

    /**
     * Display the specified RedProduccionResultado.
     */
    public function show($id)
    {
        /** @var RedProduccionResultado $redProduccionResultado */
        $redProduccionResultado = RedProduccionResultado::find($id);

        if (empty($redProduccionResultado)) {
            flash()->error('Red Producción Resultado no encontrado');

            return redirect(route('red-produccion.resultados.index'));
        }

        return view('red_produccion_resultados.show')->with('redProduccionResultado', $redProduccionResultado);
    }

    /**
     * Show the form for editing the specified RedProduccionResultado.
     */
    public function edit($id)
    {
        /** @var RedProduccionResultado $redProduccionResultado */
        $redProduccionResultado = RedProduccionResultado::find($id);

        if (empty($redProduccionResultado)) {
            flash()->error('Red Producción Resultado no encontrado');

            return redirect(route('red-produccion.resultados.index'));
        }

        return view('red_produccion_resultados.edit')->with('redProduccionResultado', $redProduccionResultado);
    }

    /**
     * Update the specified RedProduccionResultado in storage.
     */
    public function update($id, UpdateRedProduccionResultadoRequest $request)
    {
        /** @var RedProduccionResultado $redProduccionResultado */
        $redProduccionResultado = RedProduccionResultado::find($id);

        if (empty($redProduccionResultado)) {
            flash()->error('Red Producción Resultado no encontrado');

            return redirect(route('red-produccion.resultados.index'));
        }

        $redProduccionResultado->fill($request->all());
        $redProduccionResultado->save();

        flash()->success('Red Producción Resultado actualizado.');

        return redirect(route('red-produccion.resultados.index'));
    }

    /**
     * Remove the specified RedProduccionResultado from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var RedProduccionResultado $redProduccionResultado */
        $redProduccionResultado = RedProduccionResultado::find($id);

        if (empty($redProduccionResultado)) {
            flash()->error('Red Producción Resultado no encontrado');

            return redirect(route('red-produccion.resultados.index'));
        }

        $redProduccionResultado->delete();

        flash()->success('Red Producción Resultado eliminado.');

        return redirect(route('red-produccion.resultados.index'));
    }
}
