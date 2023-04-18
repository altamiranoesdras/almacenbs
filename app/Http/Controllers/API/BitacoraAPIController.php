<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBitacoraAPIRequest;
use App\Http\Requests\API\UpdateBitacoraAPIRequest;
use App\Models\Bitacora;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Response;

/**
 * Class BitacoraController
 * @package App\Http\Controllers\API
 */

class BitacoraAPIController extends AppBaseController
{
    /**
     * Display a listing of the Bitacora.
     * GET|HEAD /bitacoras
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Bitacora::with('usuario');

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        if ($request->model_type){
            $query->where('model_type',$request->model_type);
        }
        if ($request->model_id){
            $query->where('model_id',$request->model_id);
        }

        $bitacoras = $query->orderBy('created_at','desc')->get();

        if ($request->agrupar_por_seccion){
            $bitacoras = $bitacoras->groupBy('seccion');
        }

        return $this->sendResponse($bitacoras->toArray(), 'Bitacoras recuperado con éxito');
    }

    /**
     * Store a newly created Bitacora in storage.
     * POST /bitacoras
     *
     * @param CreateBitacoraAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBitacoraAPIRequest $request)
    {
        $input = $request->all();

        /** @var Bitacora $bitacora */
        $bitacora = Bitacora::create($input);

        return $this->sendResponse($bitacora->toArray(), 'Bitacora guardado exitosamente');
    }

    /**
     * Display the specified Bitacora.
     * GET|HEAD /bitacoras/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Bitacora $bitacora */
        $bitacora = Bitacora::find($id);

        if (empty($bitacora)) {
            return $this->sendError('Bitacora no encontrado');
        }

        return $this->sendResponse($bitacora->toArray(), 'Bitacora recuperado con éxito');
    }

    /**
     * Update the specified Bitacora in storage.
     * PUT/PATCH /bitacoras/{id}
     *
     * @param  int $id
     * @param UpdateBitacoraAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBitacoraAPIRequest $request)
    {
        /** @var Bitacora $bitacora */
        $bitacora = Bitacora::find($id);

        if (empty($bitacora)) {
            return $this->sendError('Bitacora no encontrado');
        }

        $bitacora->fill($request->all());
        $bitacora->save();

        return $this->sendResponse($bitacora->toArray(), 'Bitacora actualizado exitosamente');
    }

    /**
     * Remove the specified Bitacora from storage.
     * DELETE /bitacoras/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Bitacora $bitacora */
        $bitacora = Bitacora::find($id);

        if (empty($bitacora)) {
            return $this->sendError('Bitacora no encontrado');
        }

        $bitacora->delete();

        return $this->sendSuccess('Bitacora eliminado exitosamente');
    }

    public function notificar(Bitacora $bitacora)
    {
        try {
            DB::beginTransaction();

            $bitacora->notificar();

        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);

            return $this->sendError("Hubo un errro intente de nuevo.");
        }

        DB::commit();

        return $this->sendResponse([],"Listo!");
    }
}
