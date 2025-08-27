<?php

namespace App\DataTables\Scopes;

use App\Models\CompraBandeja;
use Yajra\DataTables\Contracts\DataTableScope;

class ScopeCompraRequisicion implements DataTableScope
{
    public $usuario_crea;
    public $bandeja_id;

    public function __construct(
        $usuario_crea = null,
        $bandeja_id = null

    ) {
        $req = request();
        $this->usuario_crea            = $usuario_crea ?? $req->input('usuario_crea') ?? null;
        $this->bandeja_id              = $bandeja_id ?? $req->input('bandeja_id') ?? null;
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

        if($this->bandeja_id){
            $estadosDeBandeja = CompraBandeja::find($this->bandeja_id)
                ->estados
                ->pluck('id')
                ->toArray();
            $query->whereIn('estado_id', $estadosDeBandeja);
        }

        return $query;
    }
}
