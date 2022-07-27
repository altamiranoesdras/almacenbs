<?php

namespace App\Http\Controllers;

use App\DataTables\MagnitudDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMagnitudRequest;
use App\Http\Requests\UpdateMagnitudRequest;
use App\Models\Magnitud;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MagnitudController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Magnituds')->only(['show']);
        $this->middleware('permission:Crear Magnituds')->only(['create','store']);
        $this->middleware('permission:Editar Magnituds')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Magnituds')->only(['destroy']);
    }

    /**
     * Display a listing of the Magnitud.
     *
     * @param MagnitudDataTable $magnitudDataTable
     * @return Response
     */
    public function index(MagnitudDataTable $magnitudDataTable)
    {
        return $magnitudDataTable->render('magnituds.index');
    }

    /**
     * Show the form for creating a new Magnitud.
     *
     * @return Response
     */
    public function create()
    {
        return view('magnituds.create');
    }

    /**
     * Store a newly created Magnitud in storage.
     *
     * @param CreateMagnitudRequest $request
     *
     * @return Response
     */
    public function store(CreateMagnitudRequest $request)
    {
        $input = $request->all();

        /** @var Magnitud $magnitud */
        $magnitud = Magnitud::create($input);

        Flash::success('Magnitud guardado exitosamente.');

        return redirect(route('magnituds.index'));
    }

    /**
     * Display the specified Magnitud.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Magnitud $magnitud */
        $magnitud = Magnitud::find($id);

        if (empty($magnitud)) {
            Flash::error('Magnitud no encontrado');

            return redirect(route('magnituds.index'));
        }

        return view('magnituds.show')->with('magnitud', $magnitud);
    }

    /**
     * Show the form for editing the specified Magnitud.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Magnitud $magnitud */
        $magnitud = Magnitud::find($id);

        if (empty($magnitud)) {
            Flash::error('Magnitud no encontrado');

            return redirect(route('magnituds.index'));
        }

        return view('magnituds.edit')->with('magnitud', $magnitud);
    }

    /**
     * Update the specified Magnitud in storage.
     *
     * @param  int              $id
     * @param UpdateMagnitudRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMagnitudRequest $request)
    {
        /** @var Magnitud $magnitud */
        $magnitud = Magnitud::find($id);

        if (empty($magnitud)) {
            Flash::error('Magnitud no encontrado');

            return redirect(route('magnituds.index'));
        }

        $magnitud->fill($request->all());
        $magnitud->save();

        Flash::success('Magnitud actualizado con éxito.');

        return redirect(route('magnituds.index'));
    }

    /**
     * Remove the specified Magnitud from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Magnitud $magnitud */
        $magnitud = Magnitud::find($id);

        if (empty($magnitud)) {
            Flash::error('Magnitud no encontrado');

            return redirect(route('magnituds.index'));
        }

        $magnitud->delete();

        Flash::success('Magnitud deleted successfully.');

        return redirect(route('magnituds.index'));
    }
}
