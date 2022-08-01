<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEquivalenciaAPIRequest;
use App\Http\Requests\API\UpdateEquivalenciaAPIRequest;
use App\Models\Equivalencia;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EquivalenciaController
 * @package App\Http\Controllers\API
 */

class EquivalenciaAPIController extends AppBaseController
{
    /**
     * Display a listing of the Equivalencia.
     * GET|HEAD /equivalencias
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Equivalencia::with(['itemOrigen','itemDestino']);

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }


        $equivalencias = $query->get();

        return $this->sendResponse($equivalencias->toArray(), 'Equivalencias retrieved successfully');
    }

    /**
     * Store a newly created Equivalencia in storage.
     * POST /equivalencias
     *
     * @param CreateEquivalenciaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEquivalenciaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Equivalencia $equivalencia */
        $equivalencia = Equivalencia::create($input);

        return $this->sendResponse($equivalencia->toArray(), 'Equivalencia guardado exitosamente');
    }

    /**
     * Display the specified Equivalencia.
     * GET|HEAD /equivalencias/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Equivalencia $equivalencia */
        $equivalencia = Equivalencia::find($id);

        if (empty($equivalencia)) {
            return $this->sendError('Equivalencia no encontrado');
        }

        return $this->sendResponse($equivalencia->toArray(), 'Equivalencia retrieved successfully');
    }

    /**
     * Update the specified Equivalencia in storage.
     * PUT/PATCH /equivalencias/{id}
     *
     * @param int $id
     * @param UpdateEquivalenciaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEquivalenciaAPIRequest $request)
    {
        /** @var Equivalencia $equivalencia */
        $equivalencia = Equivalencia::find($id);

        if (empty($equivalencia)) {
            return $this->sendError('Equivalencia no encontrado');
        }

        $equivalencia->fill($request->all());
        $equivalencia->save();

        return $this->sendResponse($equivalencia->toArray(), 'Equivalencia actualizado con éxito');
    }

    /**
     * Remove the specified Equivalencia from storage.
     * DELETE /equivalencias/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Equivalencia $equivalencia */
        $equivalencia = Equivalencia::find($id);

        if (empty($equivalencia)) {
            return $this->sendError('Equivalencia no encontrado');
        }

        $equivalencia->delete();

        return $this->sendSuccess('Equivalencia deleted successfully');
    }

    public function item($id)
    {
        /** @var Equivalencia $equivalencia */
        $equivalencia = Equivalencia::with(['itemOrigen','itemDestino'])
            ->where('item_origen',$id)
            ->first();

        if (empty($equivalencia)) {
            return $this->sendError('El articulo no tiene registrada equivalencia');
        }

        return $this->sendResponse($equivalencia->toArray(), 'Equivalencia: 1 '.$equivalencia->itemOrigen->nombre.'= '.$equivalencia->cantidad.' '.$equivalencia->itemDestino->nombre);
    }
}
