<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Stock
 * @package App\Models
 * @version July 27, 2022, 12:25 pm CST
 *
 * @property \App\Models\Item $item
 * @property \Illuminate\Database\Eloquent\Collection $stocksTransacciones
 * @property integer $item_id
 * @property string $lote
 * @property string|\Carbon\Carbon $fecha_ing
 * @property string $fecha_vence
 * @property number $precio_compra
 * @property number $cantidad
 * @property number $cantidad_inicial
 * @property boolean $orden_salida
 */
class Stock extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'stocks';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'item_id',
        'lote',
        'fecha_ing',
        'fecha_vence',
        'precio_compra',
        'cantidad',
        'cantidad_inicial',
        'orden_salida'
    ];

    protected $casts = [
        'id' => 'integer',
        'item_id' => 'integer',
        'lote' => 'string',
        'fecha_ing' => 'datetime',
        'fecha_vence' => 'date',
        'precio_compra' => 'decimal:2',
        'cantidad' => 'decimal:2',
        'cantidad_inicial' => 'decimal:2',
        'orden_salida' => 'boolean'
    ];

    public static $rules = [
        'item_id' => 'required',
        'lote' => 'nullable|string|max:25',
        'fecha_ing' => 'required',
        'fecha_vence' => 'nullable',
        'precio_compra' => 'required|numeric',
        'cantidad' => 'required|numeric',
        'cantidad_inicial' => 'required|numeric',
        'orden_salida' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    //---RELACIONES---

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function transaccion()
    {
        return $this->hasMany(\App\Models\StockTransaccion::class, 'stock_id');
    }

    public function kardex()
    {
        return $this->morphOne(Kardex::class,'model');
    }


    //---SCOPES---

    public function scopeConStock($query)
    {
        $query->where('cantidad','>',0);
    }

    public function scopeVencidos($query)
    {
        $hoy = Carbon::now()->format('Y-m-d');

        return $query->orWhere('fecha_vence','<',$hoy)->conStock();
    }

    public function scopeQuedanMeses($query,$meses){

        $fechaFin = Carbon::now()->addMonth($meses)->format('Y-m-d');
        $fechaIni = Carbon::now()->format('Y-m-d');

        return $query->conStock()->whereBetween('fecha_vence',[$fechaIni,$fechaFin])->vencidos();
    }



    //---MUTADORES---

    public function getCodigoAttribute()
    {
        return $this->lote ?? $this->id;
    }

    public function getResponsableAttribute()
    {
        return 'STOCK INICIAL';
    }
}
