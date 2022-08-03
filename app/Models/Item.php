<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class Item
 * @package App\Models
 * @version July 27, 2022, 12:22 pm CST
 *
 * @property \App\Models\Unimed $unimed
 * @property \App\Models\ItemCategoria $categoria
 * @property \App\Models\Renglon $renglon
 * @property \App\Models\Marca $marca
 * @property \Illuminate\Database\Eloquent\Collection $compra1hDetalles
 * @property \Illuminate\Database\Eloquent\Collection $compraDetalles
 * @property \Illuminate\Database\Eloquent\Collection $equivalencias
 * @property \Illuminate\Database\Eloquent\Collection $equivalencia1s
 * @property \Illuminate\Database\Eloquent\Collection $itemCategoria2s
 * @property \Illuminate\Database\Eloquent\Collection $itemsTraslados
 * @property \Illuminate\Database\Eloquent\Collection $itemsTraslado3s
 * @property \Illuminate\Database\Eloquent\Collection $kardexes
 * @property \Illuminate\Database\Eloquent\Collection $solicitudDetalles
 * @property \Illuminate\Database\Eloquent\Collection $stockIniciales
 * @property \Illuminate\Database\Eloquent\Collection $stocks
 * @property string $codigo
 * @property string $nombre
 * @property string $descripcion
 * @property integer $renglon_id
 * @property integer $marca_id
 * @property integer $unimed_id
 * @property integer $categoria_id
 * @property number $precio_venta
 * @property number $precio_compra
 * @property number $precio_promedio
 * @property number $stock_minimo
 * @property number $stock_maximo
 * @property string $ubicacion
 * @property boolean $perecedero
 */
class Item extends Model implements HasMedia
{
    use SoftDeletes,InteractsWithMedia;

    use HasFactory;

    public $table = 'items';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends= ['text','img','thumb','stock_total'];

    protected $with = ['unimed','marca','stocks','media'];

    public static $withoutAppends = false;

    public function scopeWithoutAppends($query)
    {
        self::$withoutAppends = true;

        return $query;
    }

    protected function getArrayableAppends()
    {
        if (self::$withoutAppends){
            return [];
        }

        return parent::getArrayableAppends();
    }



    public $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'renglon_id',
        'marca_id',
        'unimed_id',
        'categoria_id',
        'precio_venta',
        'precio_compra',
        'precio_promedio',
        'stock_minimo',
        'stock_maximo',
        'ubicacion',
        'inventariable',
        'perecedero'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'codigo' => 'string',
        'nombre' => 'string',
        'descripcion' => 'string',
        'renglon_id' => 'integer',
        'marca_id' => 'integer',
        'unimed_id' => 'integer',
        'categoria_id' => 'integer',
        'precio_venta' => 'decimal:2',
        'precio_compra' => 'decimal:2',
        'precio_promedio' => 'decimal:2',
        'stock_minimo' => 'decimal:6',
        'stock_maximo' => 'decimal:6',
        'ubicacion' => 'string',
        'perecedero' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'nullable|string|max:25',
        'nombre' => 'required|string|max:100',
        'descripcion' => 'nullable|string',
        'renglon_id' => 'required',
        'marca_id' => 'nullable',
        'unimed_id' => 'nullable',
        'categoria_id' => 'nullable',
        'precio_venta' => 'nullable|numeric',
        'precio_compra' => 'required|numeric',
        'precio_promedio' => 'nullable|numeric',
        'stock_minimo' => 'nullable|numeric',
        'stock_maximo' => 'nullable|numeric',
        'ubicacion' => 'nullable|string|max:45',
        'perecedero' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unimed()
    {
        return $this->belongsTo(\App\Models\Unimed::class, 'unimed_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function categoria()
    {
        return $this->belongsTo(\App\Models\ItemCategoria::class, 'categoria_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function renglon()
    {
        return $this->belongsTo(\App\Models\Renglon::class, 'renglon_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function marca()
    {
        return $this->belongsTo(\App\Models\Marca::class, 'marca_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function compra1hDetalles()
    {
        return $this->hasMany(\App\Models\Compra1hDetalle::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function compraDetalles()
    {
        return $this->hasMany(\App\Models\CompraDetalle::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function equivalencias()
    {
        return $this->hasMany(\App\Models\Equivalencia::class, 'item_origen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function equivalencia1s()
    {
        return $this->hasMany(\App\Models\Equivalencia::class, 'item_destino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function categorias()
    {
        return $this->belongsToMany(\App\Models\ItemCategoria::class, 'item_has_categoria','item_id','categoria_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function itemsTraslados()
    {
        return $this->hasMany(\App\Models\ItemsTraslado::class, 'item_destino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function itemsTraslado3s()
    {
        return $this->hasMany(\App\Models\ItemsTraslado::class, 'item_origen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function kardexes()
    {
        return $this->hasMany(\App\Models\Kardex::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudDetalles()
    {
        return $this->hasMany(\App\Models\SolicitudDetalle::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stockIniciales()
    {
        return $this->hasMany(\App\Models\StockIniciale::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stocks()
    {
        return $this->hasMany(\App\Models\Stock::class, 'item_id');
    }

    /**
     *MÉTODOS Y MUTADORES
     */

    /**
     * Verifica si el item esta en el detalle de una compra
     * @return bool
     */
    public function estaEnUnaCompra(){

        return $this->getEntradasStock() > 0 ? true : false;
    }

    /**
     * Verifica si el item esta en el detalle de una venta
     * @return bool
     */
    public function estaEnUnaSolicitud(){

        return $this->getSalidasStock() > 0 ? true : false;
    }

    public function getTextAttribute()
    {
        $codigo = $this->codigo ? $this->codigo : 'sin codigo';
        return $codigo.' / '.$this->nombre;
    }


    public function precioPromedio()
    {

        $promedio = $this->compraDetalles->sum('sub_total') / $this->compraDetalles->sum('cantidad');

        return round($promedio,2);
    }


    public function getImgAttribute()
    {
        $media = $this->getMedia('items')->last();
        return $media ? $media->getUrl() : asset('img/default.svg');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(270)
            ->height(270);
    }

    public function getThumbAttribute()
    {
        $media = $this->getMedia('items')->last();
        return $media ? $media->getUrl('thumb') : asset('img/default.svg');
    }

    public function relacionados($cantidad)
    {
        $items = Item::whereHas('categorias',function ($q){

            $q->whereIn('id',$this->categorias->pluck('id'));

        })->whereNotIn('id',[$this->id])->with(['media'])->web()->get();

        return $items->count() > 2 ? $items->random($cantidad) : $items->random($items->count());
    }




    /**
     *SCOPES
     */



    public function scopeDeCategoria($query,$categoria)
    {
        return $query->whereIn('id', function($q) use ($categoria){
            $q->select('item_id')->from('icategoria_item')->where('icategoria_id',$categoria)->whereNull('deleted_at');
        });
    }

    public function scopeDeMarca($query,$marca)
    {
        return $query->where('marca_id', $marca);
    }


    public function esNuevo()
    {
        $crado = Carbon::parse($this->created_at);

        return config('app.dias_producto_es_nuevo') >= Carbon::now()->diffInDays($crado);
    }



    public function getStockCalculado()
    {
        $stock = 0;

        $stockIni = $this->getStockInicial();
        $totalCompras = $this->getEntradasStock();
        $totalVentas = $this->getSalidasStock();


        if ($this->inventariable)
            return ($stockIni+$totalCompras )- $totalVentas;
        else
            return $stockIni;
    }

    public function getStockInicial()
    {
        return $this->stocks->sortBy('fecha_ing')->first()->kardex->cantidad ?? 0;
    }

    public function getEntradasStock()
    {
        $ingresos = $this->compraDetalles->filter(function ($det){


            /**
             * @var CompraDetalle $det
             */
            if ($det->compra->estado_id==CompraEstado::RECIBIDA){
                return $det;
            }
        });

        return $ingresos->sum('cantidad');
    }

    public function getSalidasStock()
    {

        $egresos = $this->solicitudDetalles->filter(function (SolicitudDetalle $det){

            if ($det->solicitud->estado_id!=SolicitudEstado::ANULADA){
                return $det;
            }
        });

        return $egresos->sum('cantidad');

    }

    public function getStockSegunKardex()
    {
        $kardex = $this->kardexs;

        $saldo = 0;

        foreach ($kardex as $index => $det) {
            $saldo+=$det->ingreso-=$det->salida;
        }

        return $saldo;
    }


    public function kardexs()
    {
        return $this->hasMany(Kardex::class,'item_id');
    }

    public function valorComparaStocks()
    {
        return valoresIgualesArray($this->getStockSegunKardex(),[(string) $this->stockTienda(), (string) $this->getStockCalculado()]);
    }

    public function puedeEditarNombre()
    {
        return !$this->estaEnUnaCompra() && !$this->estaEnUnaSolicitud();
    }

    public function puedeEditarStock()
    {
        return !$this->estaEnUnaCompra() && !$this->estaEnUnaSolicitud();
    }

    public function puedeEditarPrecioPromedio()
    {
        return $this->compraDetalles->count() == 0;
    }

    public function actualizaOregistraStcokInicial($cantidad,$tienda=null,$fecha_vence=null)
    {

        if(!$this->inventariable)
            return null;

        $tienda = session('tienda') ?? request()->tienda ?? $tienda;

        /**
         * @var Stock $stock
         */
        $stock =  $this->stocks->where('item_id',$this->id)
            ->where('tienda_id',$tienda)
            ->sortBy('orden_salida')
            ->sortBy('fecha_vence')
            ->sortBy('created_at')
            ->sortBy('id')
            ->first();

        if($stock){

            $stock->cantidad = $cantidad;
            $stock->cantidad_inicial = $cantidad;
            $stock->save();

        }else{

            $stock= Stock::create([
                'tienda_id' => $tienda,
                'item_id' => $this->id,
                'lote' =>  null,
                'fecha_vence' => $fecha_vence,
                'cantidad' =>  $cantidad,
                'cantidad_inicial' =>  $cantidad,
                'orden_salida' => 0
            ]);

        }


        if ($stock->kardex){
            $stock->kardex()->update(['cantidad' => $cantidad]);
        }else{

            if ($cantidad > 0){
                $stock->kardex()->create([
                    'tienda_id'=> $stock->tienda_id,
                    'item_id' => $stock->item_id,
                    'cantidad' => $stock->cantidad,
                    'tipo' => Kardex::TIPO_INGRESO,
                    'codigo' => $stock->id,
                    'responsable' => 'Stock Inicial',
                    'usuario_id' => auth()->user()->id
                ]);
            }
        }


        return $stock;

    }

    public function getStockTotalAttribute()
    {
        return $this->stocks->sum('cantidad');
    }
}
