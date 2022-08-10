<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ScopeStockDataTable implements DataTableScope
{
    public $mesesVence;

    /**
     * ScopeStockDataTable constructor.
     */
    public function __construct()
    {

        $this->mesesVence = request()->meses ?? 6;
    }


    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
         return $query->quedanMeses($this->mesesVence);
    }
}
