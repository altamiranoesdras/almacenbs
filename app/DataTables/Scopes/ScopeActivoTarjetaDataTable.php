<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ScopeActivoTarjetaDataTable implements DataTableScope
{

    public $nit;
    public $codigo;

    public function __construct()
    {

        $this->nit = request()->nit ?? null;
        $this->codigo = request()->codigo ?? null;

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
            $query->wherehas('responsable', function ($q) {
                $q->where('nit', $this->nit);
            });
        }

        if ($this->codigo) {
            $query->where('codigo', $this->codigo);
        }

    }
}
