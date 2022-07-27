<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRenglonAPIRequest;
use App\Http\Requests\API\UpdateRenglonAPIRequest;
use App\Models\Renglon;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RenglonController
 * @package App\Http\Controllers\API
 */

class RenglonAPIController extends AppBaseController
{
    /**
     * Display a listing of the Renglon.
     * GET|HEAD /renglons
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Renglon::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $renglons = $query->get();

        return $this->sendResponse($renglons->toArray(), 'Renglons retrieved successfully');
    }

    /**
     * Store a newly created Renglon in storage.
     * POST /renglons
     *
     * @param CreateRenglonAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRenglonAPIRequest $request)
    {
        $input = $request->all();

        /** @var Renglon $renglon */
        $renglon = Renglon::create($input);

        return $this->sendResponse($renglon->toArray(), 'Renglon guardado exitosamente');
    }

    /**
     * Display the specified Renglon.
     * GET|HEAD /renglons/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Renglon $renglon */
        $renglon = Renglon::find($id);

        if (empty($renglon)) {
            return $this->sendError('Renglon no encontrado');
        }

        return $this->sendResponse($renglon->toArray(), 'Renglon retrieved successfully');
    }

    /**
     * Update the specified Renglon in storage.
     * PUT/PATCH /renglons/{id}
     *
     * @param int $id
     * @param UpdateRenglonAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRenglonAPIRequest $request)
    {
        /** @var Renglon $renglon */
        $renglon = Renglon::find($id);

        if (empty($renglon)) {
            return $this->sendError('Renglon no encontrado');
        }

        $renglon->fill($request->all());
        $renglon->save();

        return $this->sendResponse($renglon->toArray(), 'Renglon actualizado con éxito');
    }

    /**
     * Remove the specified Renglon from storage.
     * DELETE /renglons/{id}
     *
     * @param int $id
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
            return $this->sendError('Renglon no encontrado');
        }

        $renglon->delete();

        return $this->sendSuccess('Renglon deleted successfully');
    }
}
