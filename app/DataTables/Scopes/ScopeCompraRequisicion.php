<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ScopeCompraRequisicion implements DataTableScope
{
    public $usuario_crea;

    public function __construct(
        $usuario_crea = null,

    ) {
        $req = request();
        $this->usuario_crea            = $usuario_crea ?? $req->input('usuario_crea') ?? null;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        if($this->usuario_crea){
            if(is_array($this->usuario_crea)){
                $query->whereIn('usuario_crea_id', $this->usuario_crea);
            }else {
                $query->where('usuario_crea_id', $this->usuario_crea);
            }
        }

        return $query;
    }
}
