<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEnvioFiscalAPIRequest;
use App\Http\Requests\API\UpdateEnvioFiscalAPIRequest;
use App\Models\EnvioFiscal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class EnvioFiscalAPIController
 */
class EnvioFiscalAPIController extends AppBaseController
{
    /**
     * Display a listing of the EnvioFiscals.
     * GET|HEAD /envio-fiscals
     */
    public function index(Request $request): JsonResponse
    {
        $query = EnvioFiscal::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $envioFiscales = $query->get();

        return $this->sendResponse($envioFiscales->toArray(), 'Envio Fiscals ');
    }

    /**
     * Store a newly created EnvioFiscal in storage.
     * POST /envio-fiscals
     */
    public function store(CreateEnvioFiscalAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::create($input);

        return $this->sendResponse($envioFiscal->toArray(), 'Envio Fiscal guardado');
    }

    /**
     * Display the specified EnvioFiscal.
     * GET|HEAD /envio-fiscals/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            return $this->sendError('Envio Fiscal no encontrado');
        }

        return $this->sendResponse($envioFiscal->toArray(), 'Envio Fiscal ');
    }

    /**
     * Update the specified EnvioFiscal in storage.
     * PUT/PATCH /envio-fiscals/{id}
     */
    public function update($id, UpdateEnvioFiscalAPIRequest $request): JsonResponse
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            return $this->sendError('Envio Fiscal no encontrado');
        }

        $envioFiscal->fill($request->all());
        $envioFiscal->save();

        return $this->sendResponse($envioFiscal->toArray(), 'EnvioFiscal actualizado');
    }

    /**
     * Remove the specified EnvioFiscal from storage.
     * DELETE /envio-fiscals/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            return $this->sendError('Envio Fiscal no encontrado');
        }

        $envioFiscal->delete();

        return $this->sendSuccess('Envio Fiscal eliminado');
    }
}
