<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateRedProduccionSubProductoAPIRequest;
use App\Http\Requests\API\UpdateRedProduccionSubProductoAPIRequest;
use App\Models\RedProduccionSubProducto;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class RedProduccionSubProductoAPIController
 */
class RedProduccionSubProductoAPIController extends AppBaseController
{
    /**
     * Display a listing of the RedProduccionSubProductos.
     * GET|HEAD /red-produccion-sub-productos
     */
    public function index(Request $request): JsonResponse
    {
        $query = RedProduccionSubProducto::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $redProduccionSubProductos = $query->get();

        return $this->sendResponse($redProduccionSubProductos->toArray(), 'Red Producción Sub Productos ');
    }

    /**
     * Store a newly created RedProduccionSubProducto in storage.
     * POST /red-produccion-sub-productos
     */
    public function store(CreateRedProduccionSubProductoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

//        $input['codigo'] = $this->getCodigo();

        /** @var RedProduccionSubProducto $redProduccionSubProducto */
        $redProduccionSubProducto = RedProduccionSubProducto::create($input);

        $redProduccionSubProducto->rrhhUnidades()->sync($request->get('rrhh_unidades', []));

        return $this->sendResponse($redProduccionSubProducto->toArray(), 'Red Producción Sub Producto guardado');
    }

    /**
     * Display the specified RedProduccionSubProducto.
     * GET|HEAD /red-produccion-sub-productos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var RedProduccionSubProducto $redProduccionSubProducto */
        $redProduccionSubProducto = RedProduccionSubProducto::find($id);

        if (empty($redProduccionSubProducto)) {
            return $this->sendError('Red Producción Sub Producto no encontrado');
        }

        return $this->sendResponse($redProduccionSubProducto->toArray(), 'Red Producción Sub Producto ');
    }

    /**
     * Update the specified RedProduccionSubProducto in storage.
     * PUT/PATCH /red-produccion-sub-productos/{id}
     */
    public function update($id, UpdateRedProduccionSubProductoAPIRequest $request): JsonResponse
    {
        /** @var RedProduccionSubProducto $redProduccionSubProducto */
        $redProduccionSubProducto = RedProduccionSubProducto::find($id);

        if (empty($redProduccionSubProducto)) {
            return $this->sendError('Red Producción Sub Producto no encontrado');
        }

        $redProduccionSubProducto->fill($request->all());
        $redProduccionSubProducto->save();

        $redProduccionSubProducto->rrhhUnidades()->sync($request->get('rrhh_unidades', []));

        return $this->sendResponse($redProduccionSubProducto->toArray(), 'RedProduccionSubProducto actualizado');
    }

    /**
     * Remove the specified RedProduccionSubProducto from storage.
     * DELETE /red-produccion-sub-productos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var RedProduccionSubProducto $redProduccionSubProducto */
        $redProduccionSubProducto = RedProduccionSubProducto::find($id);

        if (empty($redProduccionSubProducto)) {
            return $this->sendError('Red Producción Sub Producto no encontrado');
        }

        $redProduccionSubProducto->rrhhUnidades()->detach();

        $redProduccionSubProducto->delete();


        return $this->sendSuccess('Red Producción Sub Producto eliminado');
    }

    public function getCodigo()
    {
        $correlativo = RedProduccionSubProducto::withTrashed()
            ->whereRaw('year(created_at) ='.Carbon::now()->year)
            ->max('id');

        return 'RPSP-'.Carbon::now()->year.'-'.str_pad((int)$correlativo + 1, 6, '0', STR_PAD_LEFT);
    }
}
