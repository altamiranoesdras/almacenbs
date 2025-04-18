<?php

namespace App\Models;

use App\Traits\UseStockTransaccion;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ConsumoDetalle
 *
 * @package App\Models
 * @version December 27, 2022, 11:03 am CST
 * @property \App\Models\Consumo $consumo
 * @property \App\Models\Item $item
 * @property integer $consumo_id
 * @property integer $item_id
 * @property number $cantidad
 * @property number $precio
 * @property string $fecha_vence
 * @property string $observaciones
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StockTransaccion[] $transaccionesStock
 * @property-read int|null $transacciones_stock_count
 * @method static \Database\Factories\ConsumoDetalleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle newQuery()
 * @method static \Illuminate\Database\Query\Builder|ConsumoDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereConsumoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereFechaVence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsumoDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ConsumoDetalle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ConsumoDetalle withoutTrashed()
 * @mixin Model
 */
class ConsumoDetalle extends Model
{
    use SoftDeletes;

    use HasFactory,UseStockTransaccion;

    public $table = 'consumo_detalles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'consumo_id',
        'item_id',
        'cantidad',
        'precio',
        'fecha_vence',
        'observaciones'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'consumo_id' => 'integer',
        'item_id' => 'integer',
        'cantidad' => 'decimal:0',
        'precio' => 'decimal:0',
        'fecha_vence' => 'date',
        'observaciones' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'consumo_id' => 'required',
        'item_id' => 'required',
        'cantidad' => 'required|numeric',
        'precio' => 'nullable|numeric',
        'fecha_vence' => 'nullable',
        'observaciones' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function consumo()
    {
        return $this->belongsTo(\App\Models\Consumo::class, 'consumo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    public function kardex()
    {
        return $this->morphOne(Kardex::class,'model');
    }

    public function egreso()
    {

        $bodega = $this->consumo->bodega_id ?? Bodega::PRINCIPAL;

        if (!$this->item->inventariable)
            return null;

        $cantidad = $this->cantidad*-1;

        $stocks = $this->item->stocks
            ->where('bodega_id',$bodega)
            ->where('cantidad','>',0)
            ->sortBy('orden_salida')
            ->sortBy('fecha_vence')
            ->sortBy('created_at')
            ->sortBy('id');


        foreach ($stocks as $key => $stock) {

            /**
             * @var Stock $stock
             */

            $cantidad=($cantidad+$stock->cantidad);

            $nuevoStock = $cantidad<0 ? 0 : $cantidad;

            $rebajado= $cantidad<=0 ? $stock->cantidad : ($cantidad-$stock->cantidad)*-1;


            if($rebajado>0){
                $stock->cantidad= $nuevoStock;

                $stock->save();

                $this->addStockTransaccion(StockTransaccion::EGRESO,$stock->id,$rebajado,$stock->precio_compra);
            }

            if($cantidad>0)
                break;
        }

//        $this->kardex()->create([
//            'item_id' => $this->item->id,
//            'cantidad' => $this->cantidad,
//            'tipo' => Kardex::TIPO_SALIDA,
//            'codigo' => $this->consumo->codigo,
//            'responsable' => $this->consumo->unidad->nombre,
//            'usuario_id' => auth()->user()->id ?? User::PRINCIPAL
//        ]);

        return $stocks;

    }

    public function anular()
    {

        /**
         * @var StockTransaccion $transacion
         */
        foreach ($this->transaccionesStock as $index => $transacion) {

            $transacion->revertir();

        }
    }
}
