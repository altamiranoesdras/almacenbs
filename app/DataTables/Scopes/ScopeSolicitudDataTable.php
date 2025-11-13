<?php

namespace App\DataTables\Scopes;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Contracts\DataTableScope;

class ScopeSolicitudDataTable implements DataTableScope
{

    public $codigo;
    public $justificacion;
    public $unidades;

    public $usuarios_solicita;
    public $usuarios_autoriza;
    public $usuarios_aprueba;
    public $usuarios_despacha;


    public $del_solicita;
    public $al_solicita;

    public $del_autoriza;
    public $al_autoriza;

    public $del_aprueba;
    public $al_aprueba;

    public $del_despacha;
    public $al_despacha;

    public $estados;
    public $items;
    public $folio;

    public function __construct()
    {
        $this->codigo = request()->codigo ?? null;
        $this->justificacion = request()->justificacion ?? null;
        $this->unidades = request()->unidades ?? null;

        $this->usuarios_solicita = request()->usuarios_solicita ?? null;
        $this->usuarios_autoriza = request()->usuarios_autoriza ?? null;
        $this->usuarios_aprueba = request()->usuarios_aprueba ?? null;
        $this->usuarios_despacha = request()->usuarios_despacha ?? null;

        $this->del_solicita = request()->del_solicita ?? null;
        $this->al_solicita = request()->al_solicita ?? null;

        $this->del_autoriza = request()->del_autoriza ?? null;
        $this->al_autoriza = request()->al_autoriza ?? null;

        $this->del_aprueba = request()->del_aprueba ?? null;
        $this->al_aprueba = request()->al_aprueba ?? null;

        $this->del_despacha = request()->del_despacha ?? null;
        $this->al_despacha = request()->al_despacha ?? null;

        $this->estados = request()->estados ?? null;
        $this->items = request()->items ?? null;
        $this->folio = request()->folio ?? null;
    }


    /**
     * Apply a query scope.
     *
     * @param Builder $query
     * @return mixed
     */
    public function apply($query)
    {

        if ($this->folio) {
            $query->where('folio', 'like', "%$this->folio%");
        }

        if($this->codigo){
            $query->where('codigo','like',"%$this->codigo%");
        }

        if($this->justificacion){
            $query->where('justificacion','like',"%$this->justificacion%");
        }

        if($this->unidades){
            if (is_array($this->unidades)){
                $query->whereIn('unidad_id', $this->unidades);
            }else{
                $query->where('unidad_id', $this->unidades);
            }
        }

        if($this->usuarios_solicita){
            if (is_array($this->usuarios_solicita)){
                $query->whereIn('usuario_solicita', $this->usuarios_solicita);
            }else{
                $query->where('usuario_solicita', $this->usuarios_solicita);
            }
        }

        if($this->usuarios_autoriza){
            if (is_array($this->usuarios_autoriza)){
                $query->whereIn('usuario_autoriza', $this->usuarios_autoriza);
            }else{
                $query->where('usuario_autoriza', $this->usuarios_autoriza);
            }
        }

        if($this->usuarios_aprueba){
            if (is_array($this->usuarios_aprueba)){
                $query->whereIn('usuario_aprueba', $this->usuarios_aprueba);
            }else{
                $query->where('usuario_aprueba', $this->usuarios_aprueba);
            }
        }


        if($this->usuarios_despacha){
            if (is_array($this->usuarios_despacha)){
                $query->whereIn('usuario_despacha', $this->usuarios_despacha);
            }else{
                $query->where('usuario_despacha', $this->usuarios_despacha);
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

        if ($this->del_solicita && $this->al_solicita){

            $del = Carbon::parse($this->del_solicita)->startOfDay();
            $al = Carbon::parse($this->al_solicita)->endOfDay();

            $query->whereBetween('fecha_solicita',[$del,$al]);

        }



        return $query;
    }
}
