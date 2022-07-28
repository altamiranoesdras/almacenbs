<?php

namespace App\DataTables\Scopes;

use Carbon\Carbon;
use Yajra\DataTables\Contracts\DataTableScope;

class ScopeCompraDataTable implements DataTableScope
{


    private $proveedor;
    private $del;
    private $al;
    private $item;
    private $estado;
    private $tienda;
    private $between;
    private $codigo;

    public function __construct($proveedor=null, $del=null, $al=null, $item=null, $estado=null, $tienda=null,$codigo=null)
    {

        $this->proveedor = $proveedor;



        if($del && $al){

            $this->del = Carbon::parse($del);
            $this->al = Carbon::parse($al)->addDay(1);

            $this->between =  [$this->del,$this->al];

//            dd($this->between);
        }

        $this->item = $item;
        $this->estado = $estado;
        $this->tienda = $tienda;

        $this->codigo = $codigo;
    }


    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        if(!is_null($this->proveedor)){
            $query->where('proveedor_id', $this->proveedor);
        }

        if(!is_null($this->between)){
            $query->whereBetween('created_at',$this->between);
        }

        if(!is_null($this->item)){
            $query->whereIn('id', function($q) {
                $q->select('compra_id')->from('compra_detalles')->where('item_id',$this->item);
            });
        }
        if(!is_null($this->estado)){
            $query->where('estado_id', $this->estado);
        }
        if(!is_null($this->tienda)){

            $query->withoutGlobalScope('tienda')->where('tienda_id', $this->tienda);
        }

        if($this->codigo){

            list($tipo,$year,$correlativo)=explode('-',$this->codigo);

            $query->where('correlativo',$correlativo)->whereYear('created_at', $year);
        }

        return $query;
    }
}
