<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKardexAPIRequest;
use App\Http\Requests\API\UpdateKardexAPIRequest;
use App\Models\Kardex;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class KardexController
 * @package App\Http\Controllers\API
 */

class KardexAPIController extends AppBaseController
{
    /**
     * Display a listing of the Kardex.
     * GET|HEAD /kardexes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Kardex::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $kardexes = $query->get();

        return $this->sendResponse($kardexes->toArray(), 'Kardexes retrieved successfully');
    }

    /**
     * Store a newly created Kardex in storage.
     * POST /kardexes
     *
     * @param CreateKardexAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateKardexAPIRequest $request)
    {
        $input = $request->all();

        /** @var Kardex $kardex */
        $kardex = Kardex::create($input);

        return $this->sendResponse($kardex->toArray(), 'Kardex guardado exitosamente');
    }

    /**
     * Display the specified Kardex.
     * GET|HEAD /kardexes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Kardex $kardex */
        $kardex = Kardex::find($id);

        if (empty($kardex)) {
            return $this->sendError('Kardex no encontrado');
        }

        return $this->sendResponse($kardex->toArray(), 'Kardex retrieved successfully');
    }

    /**
     * Update the specified Kardex in storage.
     * PUT/PATCH /kardexes/{id}
     *
     * @param int $id
     * @param UpdateKardexAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKardexAPIRequest $request)
    {
        /** @var Kardex $kardex */
        $kardex = Kardex::find($id);

        if (empty($kardex)) {
            return $this->sendError('Kardex no encontrado');
        }

        $kardex->fill($request->all());
        $kardex->save();

        return $this->sendResponse($kardex->toArray(), 'Kardex actualizado con éxito');
    }

    /**
     * Remove the specified Kardex from storage.
     * DELETE /kardexes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Kardex $kardex */
        $kardex = Kardex::find($id);

        if (empty($kardex)) {
            return $this->sendError('Kardex no encontrado');
        }

        $kardex->delete();

        return $this->sendSuccess('Kardex deleted successfully');
    }
}
