<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBodegaAPIRequest;
use App\Http\Requests\API\UpdateBodegaAPIRequest;
use App\Models\Bodega;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BodegaController
 * @package App\Http\Controllers\API
 */

class BodegaAPIController extends AppBaseController
{
    /**
     * Display a listing of the Bodega.
     * GET|HEAD /bodegas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Bodega::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $bodegas = $query->get();

        return $this->sendResponse($bodegas->toArray(), 'Bodegas retrieved successfully');
    }

    /**
     * Store a newly created Bodega in storage.
     * POST /bodegas
     *
     * @param CreateBodegaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBodegaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Bodega $bodega */
        $bodega = Bodega::create($input);

        return $this->sendResponse($bodega->toArray(), 'Bodega guardado exitosamente');
    }

    /**
     * Display the specified Bodega.
     * GET|HEAD /bodegas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Bodega $bodega */
        $bodega = Bodega::find($id);

        if (empty($bodega)) {
            return $this->sendError('Bodega no encontrado');
        }

        return $this->sendResponse($bodega->toArray(), 'Bodega retrieved successfully');
    }

    /**
     * Update the specified Bodega in storage.
     * PUT/PATCH /bodegas/{id}
     *
     * @param int $id
     * @param UpdateBodegaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBodegaAPIRequest $request)
    {
        /** @var Bodega $bodega */
        $bodega = Bodega::find($id);

        if (empty($bodega)) {
            return $this->sendError('Bodega no encontrado');
        }

        $bodega->fill($request->all());
        $bodega->save();

        return $this->sendResponse($bodega->toArray(), 'Bodega actualizado con éxito');
    }

    /**
     * Remove the specified Bodega from storage.
     * DELETE /bodegas/{id}
     *
     * @param int $id
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
            return $this->sendError('Bodega no encontrado');
        }

        $bodega->delete();

        return $this->sendSuccess('Bodega deleted successfully');
    }
}
