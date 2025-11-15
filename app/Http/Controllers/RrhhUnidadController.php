<?php

namespace App\Http\Controllers;

use App\DataTables\RrhhUnidadDataTable;
use App\Http\Requests\CreateRrhhUnidadRequest;
use App\Http\Requests\UpdateRrhhUnidadRequest;
use App\Models\RrhhUnidad;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Response;
use Throwable;

class RrhhUnidadController extends AppBaseController
{

    public function __construct()
    {
//        $this->middleware('permission:Ver Unidades')->only(['show']);
//        $this->middleware('permission:Crear Unidades')->only(['create','store']);
//        $this->middleware('permission:Editar Unidades')->only(['edit','update']);
//        $this->middleware('permission:Eliminar Unidades')->only(['destroy']);
    }

    /**
     * Display a listing of the Unidad.
     *
     * @param RrhhUnidadDataTable $rrhhUnidadDataTable
     * @return Response
     */
    public function index(RrhhUnidadDataTable $rrhhUnidadDataTable)
    {
        return $rrhhUnidadDataTable->render('rrhh_unidads.index');
    }

    /**
     * Show the form for creating a new Unidad.
     *=
     */
    public function create(RrhhUnidad $unidad)
    {
        $parent = $unidad ?? null;
        $rrhhUnidad = null;

        return view('rrhh_unidads.create', compact('parent', 'rrhhUnidad'));
    }

    /**
     * Store a newly created Unidad in storage.
     *
     * @param CreateRrhhUnidadRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(CreateRrhhUnidadRequest $request)
    {
        $request->merge([
            'solicita' => $request->has('solicita') ? 'si' : 'no',
            'activa' => $request->has('activa') ? 'si' : 'no',
        ]);

        $input = $request->all();

        try {
            DB::beginTransaction();

            RrhhUnidad::create($input);

        } catch (Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);
            flash()->error($msj);

            return redirect()->back()->withInput($input);
        }

        DB::commit();


        flash()->success('Unidad guardada exitosamente.');

        return redirect(route('rrhhUnidades.index'));
    }

    /**
     * Display the specified Unidad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var RrhhUnidad $rrhhUnidad */
        $rrhhUnidad = RrhhUnidad::find($id);

        if (empty($rrhhUnidad)) {
            flash()->error('Unidad no encontrada.');

            return redirect(route('rrhhUnidads.index'));
        }

        return view('rrhh_unidads.show')->with('rrhhUnidad', $rrhhUnidad);
    }

    /**
     * Show the form for editing the specified Unidad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var RrhhUnidad $rrhhUnidad */
        $rrhhUnidad = RrhhUnidad::find($id);

        if (empty($rrhhUnidad)) {
            flash()->error('Unidad no encontrada.');

            return redirect(route('rrhhUnidads.index'));
        }

        $parent = $rrhhUnidad->parent ?? null;

        return view('rrhh_unidads.edit', compact('rrhhUnidad','parent'));
    }

    /**
     * Update the specified Unidad in storage.
     *
     * @param int $id
     * @param UpdateRrhhUnidadRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update($id, UpdateRrhhUnidadRequest $request)
    {
        $request->merge([
            'solicita' => $request->has('solicita') ? 'si' : 'no',
            'activa' => $request->has('activa') ? 'si' : 'no',
        ]);

        /** @var RrhhUnidad $rrhhUnidad */
        $rrhhUnidad = RrhhUnidad::find($id);

        if (empty($rrhhUnidad)) {
            flash()->error('Unidad no encontrada.');

            return redirect(route('rrhhUnidades.index'));
        }

        try {
            DB::beginTransaction();

            $rrhhUnidad->fill($request->all());
            $rrhhUnidad->save();

        } catch (Exception $exception) {
            DB::rollBack();

            $msj = manejarException($exception);
            flash()->error($msj);

            return redirect()->back()->withInput($request->all());
        }

        DB::commit();

        flash()->success('Unidad actualizada con éxito.');

        return redirect(route('rrhhUnidades.index'));
    }

    /**
     * Remove the specified Unidad from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var RrhhUnidad $rrhhUnidad */
        $rrhhUnidad = RrhhUnidad::find($id);

        if (empty($rrhhUnidad)) {
            flash()->error('Unidad no encontrada.');

            return redirect(route('rrhhUnidades.index'));
        }

        $rrhhUnidad->delete();

        flash()->success('Unidad eliminada exitosamente.');

        return redirect(route('rrhhUnidades.index'));
    }
}
