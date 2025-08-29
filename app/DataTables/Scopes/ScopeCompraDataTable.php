<?php

namespace App\DataTables\Scopes;

use Carbon\Carbon;
use Yajra\DataTables\Contracts\DataTableScope;

class ScopeCompraDataTable implements DataTableScope
{


    public $codigo;
    public $proveedores;
    public $items;
    public $estados;
    public $del;
    public $al;
    public $h1;
    public $unidad_solicitante;
    public $between;
    public $orden_compra;


    public function __construct()
    {

        $this->proveedores = request()->proveedores ?? null;
        $this->del = request()->del ?? null;
        $this->al = request()->al ?? null;
        $this->items = request()->items ?? null;
        $this->estados = request()->estados ?? null;
        $this->between = request()->between ?? null;
        $this->codigo = request()->codigo ?? null;
        $this->h1 = request()->h1 ?? null;
        $this->unidad_solicitante = request()->unidad_solicitante ?? null;
        $this->orden_compra = request()->orden_compra ?? null;

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

        if($this->items){
            $query->whereHas('detalles', function ($queryDetalles) {
                if (is_array($this->items)){
                    $queryDetalles->whereIn('item_id', $this->items);
                }else{
                    $queryDetalles->where('item_id', $this->items);
                }
            });
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

            $query->whereBetween('fecha_documento',[$del,$al]);

        }

        if ($this->h1) {
            $query->whereHas('compra1h', function ($q) {
                $q->where('folio', 'like', "%$this->h1%");
            });
        }

        if($this->unidad_solicitante){
            $query->whereHas('detalles', function ($queryDetalles) {
                if (is_array($this->unidad_solicitante)){
                    $queryDetalles->whereIn('unidad_solicita_id', $this->unidad_solicitante);
                }else{
                    $queryDetalles->where('unidad_solicita_id', $this->unidad_solicitante);
                }
            });
        }

        if ($this->orden_compra) {
            $query->where('orden_compra', 'like', "%$this->orden_compra%");
        }

        return $query;
    }
}
