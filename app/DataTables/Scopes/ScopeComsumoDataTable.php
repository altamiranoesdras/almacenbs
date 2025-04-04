<?php

namespace App\DataTables\Scopes;

use Carbon\Carbon;
use Yajra\DataTables\Contracts\DataTableScope;

class ScopeComsumoDataTable implements DataTableScope
{


    public $codigo;
    public $estado_id;
    public $unidad_id;
    public $bodega_id;
    public $usuario_crea;
    public $observaciones;
    public $del;
    public $al;

    public function __construct()
    {
        $this->codigo = request()->codigo ?? null;
        $this->estado_id = request()->estado_id ?? null;
        $this->unidad_id = request()->unidad_id ?? null;
        $this->bodega_id = request()->bodega_id ?? null;
        $this->usuario_crea = request()->usuario_crea ?? null;
        $this->observaciones = request()->observaciones ?? null;
        $this->del = request()->del ?? null;
        $this->al = request()->al ?? null;
    }


    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {

        if ($this->codigo) {
            $query->where('codigo', 'like', "%{$this->codigo}%");
        }

        if ($this->estado_id) {
            if (is_array($this->estado_id)) {
                $query->whereIn('estado_id', $this->estado_id);
            } else {
                $query->where('estado_id', $this->estado_id);
            }
        }

        if ($this->unidad_id) {
            if (is_array($this->unidad_id)) {
                $query->whereIn('unidad_id', $this->unidad_id);
            } else {
                $query->where('unidad_id', $this->unidad_id);
            }
        }

        if ($this->bodega_id) {
            if (is_array($this->bodega_id)) {
                $query->whereIn('bodega_id', $this->bodega_id);
            } else {
                $query->where('bodega_id', $this->bodega_id);
            }
        }

        if ($this->usuario_crea) {
            if (is_array($this->usuario_crea)) {
                $query->whereIn('usuario_crea', $this->usuario_crea);
            } else {
                $query->where('usuario_crea', $this->usuario_crea);
            }
        }

        if ($this->observaciones) {
            $query->where('observaciones', 'like', "%{$this->observaciones}%");
        }

        if ($this->del && $this->al) {
            $ini = Carbon::parse($this->del)->startOfDay();
            $fin = Carbon::parse($this->al)->endOfDay();

            $query->whereBetween('fecha_procesa',[$ini,$fin]);
        }
    }
}
