<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateConfigurationAPIRequest;
use App\Http\Requests\API\UpdateConfigurationAPIRequest;
use App\Models\Configuration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ConfigurationAPIController
 */
class ConfigurationAPIController extends AppBaseController
{
    /**
     * Display a listing of the Configurations.
     * GET|HEAD /configurations
     */
    public function index(Request $request): JsonResponse
    {
        $query = Configuration::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $configurations = $query->get();

        return $this->sendResponse($configurations->toArray(), 'Configurations retrieved successfully');
    }

    /**
     * Store a newly created Configuration in storage.
     * POST /configurations
     */
    public function store(CreateConfigurationAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Configuration $configuration */
        $configuration = Configuration::create($input);

        return $this->sendResponse($configuration->toArray(), 'Configuration saved successfully');
    }

    /**
     * Display the specified Configuration.
     * GET|HEAD /configurations/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Configuration $configuration */
        $configuration = Configuration::find($id);

        if (empty($configuration)) {
            return $this->sendError('Configuration not found');
        }

        return $this->sendResponse($configuration->toArray(), 'Configuration retrieved successfully');
    }

    /**
     * Update the specified Configuration in storage.
     * PUT/PATCH /configurations/{id}
     */
    public function update($id, UpdateConfigurationAPIRequest $request): JsonResponse
    {
        /** @var Configuration $configuration */
        $configuration = Configuration::find($id);

        if (empty($configuration)) {
            return $this->sendError('Configuration not found');
        }

        $configuration->fill($request->all());
        $configuration->save();

        return $this->sendResponse($configuration->toArray(), 'Configuration updated successfully');
    }

    /**
     * Remove the specified Configuration from storage.
     * DELETE /configurations/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Configuration $configuration */
        $configuration = Configuration::find($id);

        if (empty($configuration)) {
            return $this->sendError('Configuration not found');
        }

        $configuration->delete();

        return $this->sendSuccess('Configuration deleted successfully');
    }
}
