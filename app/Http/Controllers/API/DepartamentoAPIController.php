<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDepartamentoAPIRequest;
use App\Http\Requests\API\UpdateDepartamentoAPIRequest;
use App\Models\Departamento;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class DepartamentoAPIController
 */
class DepartamentoAPIController extends AppBaseController
{
    /**
     * Display a listing of the Departamentos.
     * GET|HEAD /departamentos
     */
    public function index(Request $request): JsonResponse
    {
        $query = Departamento::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $departamentos = $query->get();

        return $this->sendResponse($departamentos->toArray(), 'Departamentos ');
    }

    /**
     * Store a newly created Departamento in storage.
     * POST /departamentos
     */
    public function store(CreateDepartamentoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Departamento $departamento */
        $departamento = Departamento::create($input);

        return $this->sendResponse($departamento->toArray(), 'Departamento guardado');
    }

    /**
     * Display the specified Departamento.
     * GET|HEAD /departamentos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Departamento $departamento */
        $departamento = Departamento::find($id);

        if (empty($departamento)) {
            return $this->sendError('Departamento no encontrado');
        }

        return $this->sendResponse($departamento->toArray(), 'Departamento ');
    }

    /**
     * Update the specified Departamento in storage.
     * PUT/PATCH /departamentos/{id}
     */
    public function update($id, UpdateDepartamentoAPIRequest $request): JsonResponse
    {
        /** @var Departamento $departamento */
        $departamento = Departamento::find($id);

        if (empty($departamento)) {
            return $this->sendError('Departamento no encontrado');
        }

        $departamento->fill($request->all());
        $departamento->save();

        return $this->sendResponse($departamento->toArray(), 'Departamento actualizado');
    }

    /**
     * Remove the specified Departamento from storage.
     * DELETE /departamentos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Departamento $departamento */
        $departamento = Departamento::find($id);

        if (empty($departamento)) {
            return $this->sendError('Departamento no encontrado');
        }

        $departamento->delete();

        return $this->sendSuccess('Departamento eliminado');
    }
}
