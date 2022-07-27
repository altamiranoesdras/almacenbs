<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompra1hAPIRequest;
use App\Http\Requests\API\UpdateCompra1hAPIRequest;
use App\Models\Compra1h;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class Compra1hController
 * @package App\Http\Controllers\API
 */

class Compra1hAPIController extends AppBaseController
{
    /**
     * Display a listing of the Compra1h.
     * GET|HEAD /compra1hs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Compra1h::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compra1hs = $query->get();

        return $this->sendResponse($compra1hs->toArray(), 'Compra1Hs retrieved successfully');
    }

    /**
     * Store a newly created Compra1h in storage.
     * POST /compra1hs
     *
     * @param CreateCompra1hAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCompra1hAPIRequest $request)
    {
        $input = $request->all();

        /** @var Compra1h $compra1h */
        $compra1h = Compra1h::create($input);

        return $this->sendResponse($compra1h->toArray(), 'Compra1H guardado exitosamente');
    }

    /**
     * Display the specified Compra1h.
     * GET|HEAD /compra1hs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Compra1h $compra1h */
        $compra1h = Compra1h::find($id);

        if (empty($compra1h)) {
            return $this->sendError('Compra1H no encontrado');
        }

        return $this->sendResponse($compra1h->toArray(), 'Compra1H retrieved successfully');
    }

    /**
     * Update the specified Compra1h in storage.
     * PUT/PATCH /compra1hs/{id}
     *
     * @param int $id
     * @param UpdateCompra1hAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompra1hAPIRequest $request)
    {
        /** @var Compra1h $compra1h */
        $compra1h = Compra1h::find($id);

        if (empty($compra1h)) {
            return $this->sendError('Compra1H no encontrado');
        }

        $compra1h->fill($request->all());
        $compra1h->save();

        return $this->sendResponse($compra1h->toArray(), 'Compra1h actualizado con éxito');
    }

    /**
     * Remove the specified Compra1h from storage.
     * DELETE /compra1hs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Compra1h $compra1h */
        $compra1h = Compra1h::find($id);

        if (empty($compra1h)) {
            return $this->sendError('Compra1H no encontrado');
        }

        $compra1h->delete();

        return $this->sendSuccess('Compra1H deleted successfully');
    }
}
