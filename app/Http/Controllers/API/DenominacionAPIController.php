<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDenominacionAPIRequest;
use App\Http\Requests\API\UpdateDenominacionAPIRequest;
use App\Models\Denominacion;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DenominacionController
 * @package App\Http\Controllers\API
 */

class DenominacionAPIController extends AppBaseController
{
    /**
     * Display a listing of the Denominacion.
     * GET|HEAD /denominacions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Denominacion::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $denominacions = $query->get();

        return $this->sendResponse($denominacions->toArray(), 'Denominacions retrieved successfully');
    }

    /**
     * Store a newly created Denominacion in storage.
     * POST /denominacions
     *
     * @param CreateDenominacionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDenominacionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Denominacion $denominacion */
        $denominacion = Denominacion::create($input);

        return $this->sendResponse($denominacion->toArray(), 'Denominacion guardado exitosamente');
    }

    /**
     * Display the specified Denominacion.
     * GET|HEAD /denominacions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Denominacion $denominacion */
        $denominacion = Denominacion::find($id);

        if (empty($denominacion)) {
            return $this->sendError('Denominacion no encontrado');
        }

        return $this->sendResponse($denominacion->toArray(), 'Denominacion retrieved successfully');
    }

    /**
     * Update the specified Denominacion in storage.
     * PUT/PATCH /denominacions/{id}
     *
     * @param int $id
     * @param UpdateDenominacionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDenominacionAPIRequest $request)
    {
        /** @var Denominacion $denominacion */
        $denominacion = Denominacion::find($id);

        if (empty($denominacion)) {
            return $this->sendError('Denominacion no encontrado');
        }

        $denominacion->fill($request->all());
        $denominacion->save();

        return $this->sendResponse($denominacion->toArray(), 'Denominacion actualizado con éxito');
    }

    /**
     * Remove the specified Denominacion from storage.
     * DELETE /denominacions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Denominacion $denominacion */
        $denominacion = Denominacion::find($id);

        if (empty($denominacion)) {
            return $this->sendError('Denominacion no encontrado');
        }

        $denominacion->delete();

        return $this->sendSuccess('Denominacion deleted successfully');
    }
}
