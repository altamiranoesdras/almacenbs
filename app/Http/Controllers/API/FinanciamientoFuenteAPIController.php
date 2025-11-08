<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFinanciamientoFuenteAPIRequest;
use App\Http\Requests\API\UpdateFinanciamientoFuenteAPIRequest;
use App\Models\FinanciamientoFuente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class FinanciamientoFuenteAPIController
 */
class FinanciamientoFuenteAPIController extends AppBaseController
{
    /**
     * Display a listing of the FinanciamientoFuentes.
     * GET|HEAD /financiamiento-fuentes
     */
    public function index(Request $request): JsonResponse
    {
        $query = FinanciamientoFuente::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $financiamientoFuentes = $query->get();

        return $this->sendResponse($financiamientoFuentes->toArray(), 'Financiamiento Fuentes ');
    }

    /**
     * Store a newly created FinanciamientoFuente in storage.
     * POST /financiamiento-fuentes
     */
    public function store(CreateFinanciamientoFuenteAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var FinanciamientoFuente $financiamientoFuente */
        $financiamientoFuente = FinanciamientoFuente::create($input);

        return $this->sendResponse($financiamientoFuente->toArray(), 'Financiamiento Fuente guardado');
    }

    /**
     * Display the specified FinanciamientoFuente.
     * GET|HEAD /financiamiento-fuentes/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var FinanciamientoFuente $financiamientoFuente */
        $financiamientoFuente = FinanciamientoFuente::find($id);

        if (empty($financiamientoFuente)) {
            return $this->sendError('Financiamiento Fuente no encontrado');
        }

        return $this->sendResponse($financiamientoFuente->toArray(), 'Financiamiento Fuente ');
    }

    /**
     * Update the specified FinanciamientoFuente in storage.
     * PUT/PATCH /financiamiento-fuentes/{id}
     */
    public function update($id, UpdateFinanciamientoFuenteAPIRequest $request): JsonResponse
    {
        /** @var FinanciamientoFuente $financiamientoFuente */
        $financiamientoFuente = FinanciamientoFuente::find($id);

        if (empty($financiamientoFuente)) {
            return $this->sendError('Financiamiento Fuente no encontrado');
        }

        $financiamientoFuente->fill($request->all());
        $financiamientoFuente->save();

        return $this->sendResponse($financiamientoFuente->toArray(), 'FinanciamientoFuente actualizado');
    }

    /**
     * Remove the specified FinanciamientoFuente from storage.
     * DELETE /financiamiento-fuentes/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var FinanciamientoFuente $financiamientoFuente */
        $financiamientoFuente = FinanciamientoFuente::find($id);

        if (empty($financiamientoFuente)) {
            return $this->sendError('Financiamiento Fuente no encontrado');
        }

        $financiamientoFuente->delete();

        return $this->sendSuccess('Financiamiento Fuente eliminado');
    }
}
