<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ScopeActivoDataTable implements DataTableScope
{

    public $nit;
    public $codigo_activo;
    public $asignados;

    public function __construct()
    {

        $this->nit = request()->nit ?? null;
        $this->nit = request()->codigo_activo ?? null;

    }


    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {

        if ($this->nit) {
            $query->whereHas('tarjetaDetalles', function ($q) {
                $q->wherehas('tarjeta', function ($q) {
                    $q->wherehas('responsable', function ($q) {
                        $q->where('nit', $this->nit);
                    });
                });
            });
        }

        if ($this->codigo_activo) {
            $query->where('codigo_inventario', $this->codigo_activo);
        }

    }
}
