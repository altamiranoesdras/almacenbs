<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Item
 * @package App\Models
 * @version July 27, 2022, 12:22 pm CST
 *
 * @property \App\Models\Unimed $unimed
 * @property \App\Models\ItemCategoria $categoria
 * @property \App\Models\Renglone $renglon
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
class Item extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'items';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



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
        'precio_promedio' => 'required|numeric',
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
        return $this->belongsTo(\App\Models\Renglone::class, 'renglon_id');
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
    public function itemCategoria2s()
    {
        return $this->belongsToMany(\App\Models\ItemCategoria::class, 'item_has_categoria');
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
}
