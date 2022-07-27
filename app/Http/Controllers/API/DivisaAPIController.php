<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDivisaAPIRequest;
use App\Http\Requests\API\UpdateDivisaAPIRequest;
use App\Models\Divisa;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DivisaController
 * @package App\Http\Controllers\API
 */

class DivisaAPIController extends AppBaseController
{
    /**
     * Display a listing of the Divisa.
     * GET|HEAD /divisas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Divisa::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $divisas = $query->get();

        return $this->sendResponse($divisas->toArray(), 'Divisas retrieved successfully');
    }

    /**
     * Store a newly created Divisa in storage.
     * POST /divisas
     *
     * @param CreateDivisaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDivisaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Divisa $divisa */
        $divisa = Divisa::create($input);

        return $this->sendResponse($divisa->toArray(), 'Divisa guardado exitosamente');
    }

    /**
     * Display the specified Divisa.
     * GET|HEAD /divisas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Divisa $divisa */
        $divisa = Divisa::find($id);

        if (empty($divisa)) {
            return $this->sendError('Divisa no encontrado');
        }

        return $this->sendResponse($divisa->toArray(), 'Divisa retrieved successfully');
    }

    /**
     * Update the specified Divisa in storage.
     * PUT/PATCH /divisas/{id}
     *
     * @param int $id
     * @param UpdateDivisaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDivisaAPIRequest $request)
    {
        /** @var Divisa $divisa */
        $divisa = Divisa::find($id);

        if (empty($divisa)) {
            return $this->sendError('Divisa no encontrado');
        }

        $divisa->fill($request->all());
        $divisa->save();

        return $this->sendResponse($divisa->toArray(), 'Divisa actualizado con éxito');
    }

    /**
     * Remove the specified Divisa from storage.
     * DELETE /divisas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Divisa $divisa */
        $divisa = Divisa::find($id);

        if (empty($divisa)) {
            return $this->sendError('Divisa no encontrado');
        }

        $divisa->delete();

        return $this->sendSuccess('Divisa deleted successfully');
    }
}
