<?php

namespace App\Http\Controllers;

use App\DataTables\AyudaVideoDataTable;
use App\Http\Requests\CreateAyudaVideoRequest;
use App\Http\Requests\UpdateAyudaVideoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\AyudaVideo;
use Illuminate\Http\Request;

class AyudaVideoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Ayuda Videos')->only('show');
        $this->middleware('permission:Crear Ayuda Videos')->only(['create','store']);
        $this->middleware('permission:Editar Ayuda Videos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Ayuda Videos')->only('destroy');
    }
    /**
     * Display a listing of the AyudaVideo.
     */
    public function index(AyudaVideoDataTable $ayudaVideoDataTable)
    {
    return $ayudaVideoDataTable->render('ayuda_videos.index');
    }


    /**
     * Show the form for creating a new AyudaVideo.
     */
    public function create()
    {
        return view('ayuda_videos.create');
    }

    /**
     * Store a newly created AyudaVideo in storage.
     */
    public function store(CreateAyudaVideoRequest $request)
    {
        $input = $request->all();

        /** @var AyudaVideo $ayudaVideo */
        $ayudaVideo = AyudaVideo::create($input);

        flash()->success('Ayuda Video guardado.');

        return redirect(route('ayudaVideos.index'));
    }

    /**
     * Display the specified AyudaVideo.
     */
    public function show($id)
    {
        /** @var AyudaVideo $ayudaVideo */
        $ayudaVideo = AyudaVideo::find($id);

        if (empty($ayudaVideo)) {
            flash()->error('Ayuda Video no encontrado');

            return redirect(route('ayudaVideos.index'));
        }

        return view('ayuda_videos.show')->with('ayudaVideo', $ayudaVideo);
    }

    /**
     * Show the form for editing the specified AyudaVideo.
     */
    public function edit($id)
    {
        /** @var AyudaVideo $ayudaVideo */
        $ayudaVideo = AyudaVideo::find($id);

        if (empty($ayudaVideo)) {
            flash()->error('Ayuda Video no encontrado');

            return redirect(route('ayudaVideos.index'));
        }

        return view('ayuda_videos.edit')->with('ayudaVideo', $ayudaVideo);
    }

    /**
     * Update the specified AyudaVideo in storage.
     */
    public function update($id, UpdateAyudaVideoRequest $request)
    {
        /** @var AyudaVideo $ayudaVideo */
        $ayudaVideo = AyudaVideo::find($id);

        if (empty($ayudaVideo)) {
            flash()->error('Ayuda Video no encontrado');

            return redirect(route('ayudaVideos.index'));
        }

        $ayudaVideo->fill($request->all());
        $ayudaVideo->save();

        flash()->success('Ayuda Video actualizado.');

        return redirect(route('ayudaVideos.index'));
    }

    /**
     * Remove the specified AyudaVideo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var AyudaVideo $ayudaVideo */
        $ayudaVideo = AyudaVideo::find($id);

        if (empty($ayudaVideo)) {
            flash()->error('Ayuda Video no encontrado');

            return redirect(route('ayudaVideos.index'));
        }

        $ayudaVideo->delete();

        flash()->success('Ayuda Video eliminado.');

        return redirect(route('ayudaVideos.index'));
    }
}
