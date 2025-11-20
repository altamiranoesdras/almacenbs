<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAyudaVideoAPIRequest;
use App\Http\Requests\API\UpdateAyudaVideoAPIRequest;
use App\Models\AyudaVideo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class AyudaVideoAPIController
 */
class AyudaVideoAPIController extends AppBaseController
{
    /**
     * Display a listing of the AyudaVideos.
     * GET|HEAD /ayuda-videos
     */
    public function index(Request $request): JsonResponse
    {
        $query = AyudaVideo::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $ayudaVideos = $query->get();

        return $this->sendResponse($ayudaVideos->toArray(), 'Ayuda Videos ');
    }

    /**
     * Store a newly created AyudaVideo in storage.
     * POST /ayuda-videos
     */
    public function store(CreateAyudaVideoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var AyudaVideo $ayudaVideo */
        $ayudaVideo = AyudaVideo::create($input);

        return $this->sendResponse($ayudaVideo->toArray(), 'Ayuda Video guardado');
    }

    /**
     * Display the specified AyudaVideo.
     * GET|HEAD /ayuda-videos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var AyudaVideo $ayudaVideo */
        $ayudaVideo = AyudaVideo::find($id);

        if (empty($ayudaVideo)) {
            return $this->sendError('Ayuda Video no encontrado');
        }

        return $this->sendResponse($ayudaVideo->toArray(), 'Ayuda Video ');
    }

    /**
     * Update the specified AyudaVideo in storage.
     * PUT/PATCH /ayuda-videos/{id}
     */
    public function update($id, UpdateAyudaVideoAPIRequest $request): JsonResponse
    {
        /** @var AyudaVideo $ayudaVideo */
        $ayudaVideo = AyudaVideo::find($id);

        if (empty($ayudaVideo)) {
            return $this->sendError('Ayuda Video no encontrado');
        }

        $ayudaVideo->fill($request->all());
        $ayudaVideo->save();

        return $this->sendResponse($ayudaVideo->toArray(), 'AyudaVideo actualizado');
    }

    /**
     * Remove the specified AyudaVideo from storage.
     * DELETE /ayuda-videos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var AyudaVideo $ayudaVideo */
        $ayudaVideo = AyudaVideo::find($id);

        if (empty($ayudaVideo)) {
            return $this->sendError('Ayuda Video no encontrado');
        }

        $ayudaVideo->delete();

        return $this->sendSuccess('Ayuda Video eliminado');
    }
}
