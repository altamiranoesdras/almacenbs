<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateRedProduccionResultadoAPIRequest;
use App\Http\Requests\API\UpdateRedProduccionResultadoAPIRequest;
use App\Models\RedProduccionResultado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class RedProduccionResultadoAPIController
 */
class RedProduccionResultadoAPIController extends AppBaseController
{
    /**
     * Display a listing of the RedProduccionResultados.
     * GET|HEAD /red-produccion-resultados
     */
    public function index(Request $request): JsonResponse
    {
        $query = RedProduccionResultado::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $redProduccionResultados = $query->with('productos.subproductos')
            ->get();

        return $this->sendResponse($redProduccionResultados->toArray(), 'Red Producción Resultados ');
    }

    /**
     * Store a newly created RedProduccionResultado in storage.
     * POST /red-produccion-resultados
     */
    public function store(CreateRedProduccionResultadoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        //generar un correlativo asi 00-001 en base al id del ultimo registro
        $last = RedProduccionResultado::orderBy('id', 'desc')->first();
        if (!$last) {
            $input['codigo'] = '00-001';
        } else {
            $number = (int) $last->id;
            $number++;
            $input['codigo'] = '00-' . str_pad($number, 3, '0', STR_PAD_LEFT);
        }

        /** @var RedProduccionResultado $redProduccionResultado */
        $redProduccionResultado = RedProduccionResultado::create($input);

        return $this->sendResponse($redProduccionResultado->toArray(), 'Red Producción Resultado guardado');
    }

    /**
     * Display the specified RedProduccionResultado.
     * GET|HEAD /red-produccion-resultados/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var RedProduccionResultado $redProduccionResultado */
        $redProduccionResultado = RedProduccionResultado::find($id);

        if (empty($redProduccionResultado)) {
            return $this->sendError('Red Producción Resultado no encontrado');
        }

        return $this->sendResponse($redProduccionResultado->toArray(), 'Red Producción Resultado ');
    }

    /**
     * Update the specified RedProduccionResultado in storage.
     * PUT/PATCH /red-produccion-resultados/{id}
     */
    public function update($id, UpdateRedProduccionResultadoAPIRequest $request): JsonResponse
    {
        /** @var RedProduccionResultado $redProduccionResultado */
        $redProduccionResultado = RedProduccionResultado::find($id);

        if (empty($redProduccionResultado)) {
            return $this->sendError('Red Producción Resultado no encontrado');
        }

        $redProduccionResultado->fill($request->all());
        $redProduccionResultado->save();

        return $this->sendResponse($redProduccionResultado->toArray(), 'RedProduccionResultado actualizado');
    }

    /**
     * Remove the specified RedProduccionResultado from storage.
     * DELETE /red-produccion-resultados/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var RedProduccionResultado $redProduccionResultado */
        $redProduccionResultado = RedProduccionResultado::find($id);

        if (empty($redProduccionResultado)) {
            return $this->sendError('Red Producción Resultado no encontrado');
        }

        $redProduccionResultado->delete();

        return $this->sendSuccess('Red Producción Resultado eliminado');
    }
}
