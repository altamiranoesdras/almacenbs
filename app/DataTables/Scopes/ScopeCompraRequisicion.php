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
    public $unidad_id;
    public $estado_id;
    public $codigo_consolidacion;

    public function __construct(
        $usuario_crea = null,
        $bandeja = null,
        $unidad_id = null,
        $estado_id = null,
        $codigo_consolidacion = null

    ) {
        $req = request();
        $this->usuario_crea            = $usuario_crea ?? $req->input('usuario_crea') ?? null;
        $this->bandeja                 = $bandeja    ?? $req->input('bandeja') ? CompraBandeja::find($req->input('bandeja')) : null;
        $this->unidad_id               = $unidad_id    ?? $req->input('unidad_id') ?? null;
        $this->estado_id               = $estado_id    ?? $req->input('estado_id') ?? null;
        $this->codigo_consolidacion    = $codigo_consolidacion    ?? $req->input('codigo_consolidacion') ?? null;
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

        if($this->unidad_id){
            if(is_array($this->unidad_id)){
                $query->whereIn('unidad_id', $this->unidad_id);
            }else {
                $query->where('unidad_id', $this->unidad_id);
            }
        }

        if($this->estado_id){
            if(is_array($this->estado_id)){
                $query->whereIn('estado_id', $this->estado_id);
            }else {
                $query->where('estado_id', $this->estado_id);
            }
        }

        if($this->codigo_consolidacion){
            $query->where('codigo_consolidacion', 'like', '%'.$this->codigo_consolidacion.'%');
        }

        return $query;
    }
}
