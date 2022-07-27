<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMagnitudAPIRequest;
use App\Http\Requests\API\UpdateMagnitudAPIRequest;
use App\Models\Magnitud;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MagnitudController
 * @package App\Http\Controllers\API
 */

class MagnitudAPIController extends AppBaseController
{
    /**
     * Display a listing of the Magnitud.
     * GET|HEAD /magnituds
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Magnitud::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $magnituds = $query->get();

        return $this->sendResponse($magnituds->toArray(), 'Magnituds retrieved successfully');
    }

    /**
     * Store a newly created Magnitud in storage.
     * POST /magnituds
     *
     * @param CreateMagnitudAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMagnitudAPIRequest $request)
    {
        $input = $request->all();

        /** @var Magnitud $magnitud */
        $magnitud = Magnitud::create($input);

        return $this->sendResponse($magnitud->toArray(), 'Magnitud guardado exitosamente');
    }

    /**
     * Display the specified Magnitud.
     * GET|HEAD /magnituds/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Magnitud $magnitud */
        $magnitud = Magnitud::find($id);

        if (empty($magnitud)) {
            return $this->sendError('Magnitud no encontrado');
        }

        return $this->sendResponse($magnitud->toArray(), 'Magnitud retrieved successfully');
    }

    /**
     * Update the specified Magnitud in storage.
     * PUT/PATCH /magnituds/{id}
     *
     * @param int $id
     * @param UpdateMagnitudAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMagnitudAPIRequest $request)
    {
        /** @var Magnitud $magnitud */
        $magnitud = Magnitud::find($id);

        if (empty($magnitud)) {
            return $this->sendError('Magnitud no encontrado');
        }

        $magnitud->fill($request->all());
        $magnitud->save();

        return $this->sendResponse($magnitud->toArray(), 'Magnitud actualizado con éxito');
    }

    /**
     * Remove the specified Magnitud from storage.
     * DELETE /magnituds/{id}
     *
     * @param int $id
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
            return $this->sendError('Magnitud no encontrado');
        }

        $magnitud->delete();

        return $this->sendSuccess('Magnitud deleted successfully');
    }
}
