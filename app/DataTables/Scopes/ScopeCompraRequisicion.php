<?php

namespace App\DataTables\Scopes;

use App\Models\CompraBandeja;
use Yajra\DataTables\Contracts\DataTableScope;

/**
 * Class ScopeCompraRequisicion
 * @package App\DataTables\Scopes
 */
class ScopeCompraRequisicion implements DataTableScope
{
    /**
     * @var mixed|null
     */
    public $usuario_crea;
    /**
     * @var CompraBandeja|null
     */
    public $bandeja;

    public function __construct() {
        $req = request();
        $this->usuario_crea = request()->usuario_crea ?? null;
        $this->bandeja  = request()->bandeja ?? null;
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

        if($this->bandeja){
            $estadosDeBandeja = $this->bandeja->estados->pluck('id')->toArray();
            $query->whereIn('estado_id', $estadosDeBandeja);
        }

        return $query;
    }
}
