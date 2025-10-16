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

    public $usuario_crea;
    public $usuario_aprueba;
    public $usuario_autoriza;


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
        $this->usuario_crea = request()->usuario_crea ?? null;
        $this->usuario_aprueba = request()->usuario_aprueba ?? null;
        $this->usuario_autoriza = request()->usuario_autoriza ?? null;

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

        if ($this->usuario_crea) {
            if(is_array($this->usuario_crea)){
                $query->whereIn('usuario_crea_id', $this->usuario_crea);
            }else {
                $query->where('usuario_crea_id', $this->usuario_crea);
            }
        }

        if ($this->usuario_aprueba) {
            if(is_array($this->usuario_aprueba)){
                $query->whereIn('usuario_aprueba_id', $this->usuario_aprueba);
            }else {
                $query->where('usuario_aprueba_id', $this->usuario_aprueba);
            }
        }

        if ($this->usuario_autoriza) {
            if(is_array($this->usuario_autoriza)){
                $query->whereIn('usuario_autoriza_id', $this->usuario_autoriza);
            }else {
                $query->where('usuario_autoriza_id', $this->usuario_autoriza);
            }
        }

        return $query;
    }
}
