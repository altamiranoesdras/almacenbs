<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFinanciamientoFuentAPIRequest;
use App\Http\Requests\API\UpdateFinanciamientoFuentAPIRequest;
use App\Models\FinanciamientoFuent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class FinanciamientoFuentAPIController
 */
class FinanciamientoFuentAPIController extends AppBaseController
{
    /**
     * Display a listing of the FinanciamientoFuents.
     * GET|HEAD /financiamiento-fuents
     */
    public function index(Request $request): JsonResponse
    {
        $query = FinanciamientoFuent::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $financiamientoFuents = $query->get();

        return $this->sendResponse($financiamientoFuents->toArray(), 'Financiamiento Fuents ');
    }

    /**
     * Store a newly created FinanciamientoFuent in storage.
     * POST /financiamiento-fuents
     */
    public function store(CreateFinanciamientoFuentAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var FinanciamientoFuent $financiamientoFuent */
        $financiamientoFuent = FinanciamientoFuent::create($input);

        return $this->sendResponse($financiamientoFuent->toArray(), 'Financiamiento Fuent guardado');
    }

    /**
     * Display the specified FinanciamientoFuent.
     * GET|HEAD /financiamiento-fuents/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var FinanciamientoFuent $financiamientoFuent */
        $financiamientoFuent = FinanciamientoFuent::find($id);

        if (empty($financiamientoFuent)) {
            return $this->sendError('Financiamiento Fuent no encontrado');
        }

        return $this->sendResponse($financiamientoFuent->toArray(), 'Financiamiento Fuent ');
    }

    /**
     * Update the specified FinanciamientoFuent in storage.
     * PUT/PATCH /financiamiento-fuents/{id}
     */
    public function update($id, UpdateFinanciamientoFuentAPIRequest $request): JsonResponse
    {
        /** @var FinanciamientoFuent $financiamientoFuent */
        $financiamientoFuent = FinanciamientoFuent::find($id);

        if (empty($financiamientoFuent)) {
            return $this->sendError('Financiamiento Fuent no encontrado');
        }

        $financiamientoFuent->fill($request->all());
        $financiamientoFuent->save();

        return $this->sendResponse($financiamientoFuent->toArray(), 'FinanciamientoFuent actualizado');
    }

    /**
     * Remove the specified FinanciamientoFuent from storage.
     * DELETE /financiamiento-fuents/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var FinanciamientoFuent $financiamientoFuent */
        $financiamientoFuent = FinanciamientoFuent::find($id);

        if (empty($financiamientoFuent)) {
            return $this->sendError('Financiamiento Fuent no encontrado');
        }

        $financiamientoFuent->delete();

        return $this->sendSuccess('Financiamiento Fuent eliminado');
    }
}
