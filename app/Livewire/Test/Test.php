<?php

namespace App\Livewire\Test;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Test extends Component
{

    public $resultado = 0;
    public $data = [];
    public $filteredRoutes;


    public function mount(){

    }

    public function sumar(){
        $this->resultado++;
    }

    public function obtenerRutasIndexCreate(){
        // Filtrar rutas que terminan en .index o .create
        $this->filteredRoutes = $this->getFilteredRoutes();
        dd($this->filteredRoutes);
    }

    public function getFilteredRoutes(){
        // Obtener todas las rutas
        $routes = Route::getRoutes();

        // Mapear y filtrar las propiedades deseadas
        $filteredRoutes = collect($routes)->filter(function ($route) {
            $routeName = $route->getAction('as'); // Obtener el nombre de la ruta
            return $routeName && Str::endsWith($routeName, ['.index']);
            return $routeName && Str::endsWith($routeName, ['.index', '.create']);
        })->map(function ($route) {
            return [
                'action'  => $route->getAction(),
            ];
        });

        $routes = collect();

        foreach ($filteredRoutes as $route) {
            $item = [
                'name'  => $route['action']['as'],
            ];

            $routes->push($item);
        }

        // Retornar las rutas filtradas
        return $routes;
    }

    public function render()
    {
        return view('livewire.test.test');
    }
}
