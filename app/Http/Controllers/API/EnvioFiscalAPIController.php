<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEnvioFiscalAPIRequest;
use App\Http\Requests\API\UpdateEnvioFiscalAPIRequest;
use App\Models\EnvioFiscal;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EnvioFiscalController
 * @package App\Http\Controllers\API
 */

class EnvioFiscalAPIController extends AppBaseController
{
    /**
     * Display a listing of the EnvioFiscal.
     * GET|HEAD /envioFiscals
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = EnvioFiscal::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $envioFiscals = $query->get();

        return $this->sendResponse($envioFiscals->toArray(), 'Envio Fiscals retrieved successfully');
    }

    /**
     * Store a newly created EnvioFiscal in storage.
     * POST /envioFiscals
     *
     * @param CreateEnvioFiscalAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEnvioFiscalAPIRequest $request)
    {
        $input = $request->all();

        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::create($input);

        return $this->sendResponse($envioFiscal->toArray(), 'Envio Fiscal guardado exitosamente');
    }

    /**
     * Display the specified EnvioFiscal.
     * GET|HEAD /envioFiscals/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            return $this->sendError('Envio Fiscal no encontrado');
        }

        return $this->sendResponse($envioFiscal->toArray(), 'Envio Fiscal retrieved successfully');
    }

    /**
     * Update the specified EnvioFiscal in storage.
     * PUT/PATCH /envioFiscals/{id}
     *
     * @param int $id
     * @param UpdateEnvioFiscalAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEnvioFiscalAPIRequest $request)
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            return $this->sendError('Envio Fiscal no encontrado');
        }

        $envioFiscal->fill($request->all());
        $envioFiscal->save();

        return $this->sendResponse($envioFiscal->toArray(), 'EnvioFiscal actualizado con éxito');
    }

    /**
     * Remove the specified EnvioFiscal from storage.
     * DELETE /envioFiscals/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EnvioFiscal $envioFiscal */
        $envioFiscal = EnvioFiscal::find($id);

        if (empty($envioFiscal)) {
            return $this->sendError('Envio Fiscal no encontrado');
        }

        $envioFiscal->delete();

        return $this->sendSuccess('Envio Fiscal deleted successfully');
    }
}
