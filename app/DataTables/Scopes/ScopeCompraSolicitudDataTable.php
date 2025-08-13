<?php

namespace App\DataTables\Scopes;

use Carbon\Carbon;
use Yajra\DataTables\Contracts\DataTableScope;

class ScopeCompraSolicitudDataTable implements DataTableScope
{


    public $items;
    public $estados;
    public $proveedores;
    public $codigo;
    public $del;
    public $al;
    public $usuario_solicita;
    public $unidad_id;

    public function __construct(
        $usuario_solicita = null,
        $estados = null,
        $proveedores = null,
        $items = null,
        $codigo = null,
        $del = null,
        $al = null,
        $unidad_id = null
    ) {
        $req = request();

        $this->items            = $items            ?? $req->input('items')            ?? null;
        $this->estados          = $estados          ?? $req->input('estados')          ?? null;
        $this->proveedores      = $proveedores      ?? $req->input('proveedores')      ?? null;
        $this->codigo           = $codigo           ?? $req->input('codigo')           ?? null;
        $this->del              = $del              ?? $req->input('del')              ?? null;
        $this->al               = $al               ?? $req->input('al')               ?? null;
        $this->usuario_solicita = $usuario_solicita ?? $req->input('usuario_solicita') ?? null;
        $this->unidad_id        = $unidad_id        ?? $req->input('unidad_id')        ?? null;
    }


    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {

        if($this->codigo){
            $query->where('codigo','like',"%$this->codigo%");
        }

        if($this->proveedores){
            if (is_array($this->proveedores)){
                $query->whereIn('proveedor_id', $this->proveedores);
            }else{
                $query->where('proveedor_id', $this->proveedores);
            }
        }

        if($this->estados){
            if (is_array($this->estados)){
                $query->whereIn('estado_id', $this->estados);
            }else{
                $query->where('estado_id', $this->estados);
            }
        }

        if ($this->del && $this->al){

            $del = Carbon::parse($this->del)->startOfDay();
            $al = Carbon::parse($this->al)->endOfDay();

            $query->whereBetween('compra_solicitudes.created_at',[$del,$al]);

        }

        if($this->items){
            $query->whereHas('detalles', function ($queryDetalles) {
                if (is_array($this->items)){
                    $queryDetalles->whereIn('item_id', $this->items);
                }else{
                    $queryDetalles->where('item_id', $this->items);
                }
            });
        }

        if($this->usuario_solicita){
            $query->where('usuario_solicita', $this->usuario_solicita);
        }

        return $query;
    }
}
