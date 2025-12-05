<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class IconSearchController extends Controller
{
    /**
     * Busca iconos en el JSON generado desde Font Awesome.
     */
    public function buscar(Request $request)
    {
        // valido parámetro q
        $request->validate([
            'q' => 'nullable|string|max:50',
        ]);

        $query = mb_strtolower($request->q ?? '');

        // Cargo el JSON desde cache o archivo
        $icons = Cache::rememberForever('fa_icons_list', function () {
            if (!Storage::exists('fa-icons.json')) {
                return [];
            }

            return json_decode(Storage::get('fa-icons.json'), true) ?: [];
        });

        // Si no hay búsqueda → devolver primeros 5 para mostrar sugerencias
        if ($query === '') {
            return response()->json(array_slice($icons, 0, 5));
        }

        // Filtrar
        $filtered = array_filter($icons, function ($icon) use ($query) {
            return str_contains(mb_strtolower($icon['id']), $query)
                || str_contains(mb_strtolower($icon['label']), $query);
        });

        // Devolver máximo 5 resultados
        return response()->json(array_slice(array_values($filtered), 0, 5));
    }
}
