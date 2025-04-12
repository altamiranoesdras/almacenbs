<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ScopeItemDataTable implements DataTableScope
{

    private $codigo;
    private $codigo_insumo;
    private $codigo_presentacion;
    private $nombre;
    private $descripcion;

    private $tipos;
    private $renglones;
    private $marcas;
    private $unidades;
    private $presentaciones;
    private $categorias;

    private $precio_venta;
    private $precio_compra;
    private $precio_promedio;
    private $stock_minimo;
    private $stock_maximo;
    private $ubicacion;
    private $inventariable;

    /**
     * ScopeItemDataTable constructor.
     */
    public function __construct()
    {
        $this->codigo = request()->codigo ?? null;
        $this->codigo_insumo = request()->codigo_insumo ?? null;
        $this->codigo_presentacion = request()->codigo_presentacion ?? null;
        $this->nombre = request()->nombre ?? null;
        $this->descripcion = request()->descripcion ?? null;
        $this->tipos = request()->tipos ?? null;
        $this->renglones = request()->renglones ?? null;
        $this->marcas = request()->marcas ?? null;
        $this->unidades = request()->unidades ?? null;
        $this->presentaciones = request()->presentaciones ?? null;
        $this->categorias = request()->categorias ?? null;
        $this->precio_venta = request()->precio_venta ?? null;
        $this->precio_compra = request()->precio_compra ?? null;
        $this->precio_promedio = request()->precio_promedio ?? null;
        $this->stock_minimo = request()->stock_minimo ?? null;
        $this->stock_maximo = request()->stock_maximo ?? null;
        $this->ubicacion = request()->ubicacion ?? null;
        $this->inventariable = request()->inventariable ?? null;
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
            $query->where('codigo', $this->codigo);
        }

        if($this->codigo_insumo){
            $query->where('codigo_insumo', $this->codigo_insumo);
        }

        if($this->codigo_presentacion){
            $query->where('codigo_presentacion', $this->codigo_presentacion);
        }

        if($this->nombre){
            $query->where('nombre', $this->nombre);
        }

        if($this->descripcion){
            $query->where('descripcion', $this->descripcion);
        }

        if($this->tipos){
            if (is_array($this->tipos)){
                $query->whereIn('tipo_id', $this->tipos);
            }else{
                $query->where('tipo_id', $this->tipos);
            }
        }

        if($this->renglones){
            if (is_array($this->renglones)){
                $query->whereIn('renglon_id', $this->renglones);
            }else{
                $query->where('renglon_id', $this->renglones);
            }
        }

        if($this->marcas){
            if (is_array($this->marcas)){
                $query->whereIn('marca_id', $this->marcas);
            }else{
                $query->where('marca_id', $this->marcas);
            }
        }

        if($this->unidades){
            if (is_array($this->unidades)){
                $query->whereIn('unimed_id', $this->unidades);
            }else{
                $query->where('unimed_id', $this->unidades);
            }
        }

        if($this->presentaciones){
            if (is_array($this->presentaciones)){
                $query->whereIn('presentacion_id', $this->presentaciones);
            }else{
                $query->where('presentacion_id', $this->presentaciones);
            }
        }

        if($this->categorias){
            if (is_array($this->categorias)){
                $query->whereIn('categoria_id', $this->categorias);
            }else{
                $query->where('categoria_id', $this->categorias);
            }
        }

        if($this->precio_venta){
            if (is_array($this->precio_venta)){
                $query->whereIn('precio_venta', $this->precio_venta);
            }else{
                $query->where('precio_venta', $this->precio_venta);
            }
        }

        if($this->precio_compra){
            if (is_array($this->precio_compra)){
                $query->whereIn('precio_compra', $this->precio_compra);
            }else{
                $query->where('precio_compra', $this->precio_compra);
            }
        }

        if($this->precio_promedio){
            if (is_array($this->precio_promedio)){
                $query->whereIn('precio_promedio', $this->precio_promedio);
            }else{
                $query->where('precio_promedio', $this->precio_promedio);
            }
        }

        if($this->stock_minimo){
            if (is_array($this->stock_minimo)){
                $query->whereIn('stock_minimo', $this->stock_minimo);
            }else{
                $query->where('stock_minimo', $this->stock_minimo);
            }
        }

        if($this->stock_maximo){
            if (is_array($this->stock_maximo)){
                $query->whereIn('stock_maximo', $this->stock_maximo);
            }else{
                $query->where('stock_maximo', $this->stock_maximo);
            }
        }

        if($this->ubicacion){
            if (is_array($this->ubicacion)){
                $query->whereIn('ubicacion', $this->ubicacion);
            }else{
                $query->where('ubicacion', $this->ubicacion);
            }
        }

        if($this->inventariable){
            if (is_array($this->inventariable)){
                $query->whereIn('inventariable', $this->inventariable);
            }else{
                $query->where('inventariable', $this->inventariable);
            }
        }
    }
}
