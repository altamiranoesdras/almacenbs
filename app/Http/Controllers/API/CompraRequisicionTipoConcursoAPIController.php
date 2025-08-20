<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompraRequisicionTipoConcursoAPIRequest;
use App\Http\Requests\API\UpdateCompraRequisicionTipoConcursoAPIRequest;
use App\Models\CompraRequisicionTipoConcurso;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CompraRequisicionTipoConcursoAPIController
 */
class CompraRequisicionTipoConcursoAPIController extends AppBaseController
{
    /**
     * Display a listing of the CompraRequisicionTipoConcursos.
     * GET|HEAD /compra-requisicion-tipo-concursos
     */
    public function index(Request $request): JsonResponse
    {
        $query = CompraRequisicionTipoConcurso::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $compraRequisicionTipoConcursos = $query->get();

        return $this->sendResponse($compraRequisicionTipoConcursos->toArray(), 'Compra Requisicion Tipo Concursos ');
    }

    /**
     * Store a newly created CompraRequisicionTipoConcurso in storage.
     * POST /compra-requisicion-tipo-concursos
     */
    public function store(CreateCompraRequisicionTipoConcursoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var CompraRequisicionTipoConcurso $compraRequisicionTipoConcurso */
        $compraRequisicionTipoConcurso = CompraRequisicionTipoConcurso::create($input);

        return $this->sendResponse($compraRequisicionTipoConcurso->toArray(), 'Compra Requisicion Tipo Concurso guardado');
    }

    /**
     * Display the specified CompraRequisicionTipoConcurso.
     * GET|HEAD /compra-requisicion-tipo-concursos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var CompraRequisicionTipoConcurso $compraRequisicionTipoConcurso */
        $compraRequisicionTipoConcurso = CompraRequisicionTipoConcurso::find($id);

        if (empty($compraRequisicionTipoConcurso)) {
            return $this->sendError('Compra Requisicion Tipo Concurso no encontrado');
        }

        return $this->sendResponse($compraRequisicionTipoConcurso->toArray(), 'Compra Requisicion Tipo Concurso ');
    }

    /**
     * Update the specified CompraRequisicionTipoConcurso in storage.
     * PUT/PATCH /compra-requisicion-tipo-concursos/{id}
     */
    public function update($id, UpdateCompraRequisicionTipoConcursoAPIRequest $request): JsonResponse
    {
        /** @var CompraRequisicionTipoConcurso $compraRequisicionTipoConcurso */
        $compraRequisicionTipoConcurso = CompraRequisicionTipoConcurso::find($id);

        if (empty($compraRequisicionTipoConcurso)) {
            return $this->sendError('Compra Requisicion Tipo Concurso no encontrado');
        }

        $compraRequisicionTipoConcurso->fill($request->all());
        $compraRequisicionTipoConcurso->save();

        return $this->sendResponse($compraRequisicionTipoConcurso->toArray(), 'CompraRequisicionTipoConcurso actualizado');
    }

    /**
     * Remove the specified CompraRequisicionTipoConcurso from storage.
     * DELETE /compra-requisicion-tipo-concursos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var CompraRequisicionTipoConcurso $compraRequisicionTipoConcurso */
        $compraRequisicionTipoConcurso = CompraRequisicionTipoConcurso::find($id);

        if (empty($compraRequisicionTipoConcurso)) {
            return $this->sendError('Compra Requisicion Tipo Concurso no encontrado');
        }

        $compraRequisicionTipoConcurso->delete();

        return $this->sendSuccess('Compra Requisicion Tipo Concurso eliminado');
    }
}
