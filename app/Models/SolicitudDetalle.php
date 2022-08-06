<?php

namespace App\Models;

use App\Traits\UseStockTransaccion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SolicitudDetalle
 * @package App\Models
 * @version July 27, 2022, 12:25 pm CST
 *
 * @property Item $item
 * @property Solicitud $solicitud
 * @property integer $solicitud_id
 * @property integer $item_id
 * @property number $cantidad
 * @property number $precio
 */
class SolicitudDetalle extends Model
{
    use SoftDeletes,UseStockTransaccion;

    use HasFactory;

    public $table = 'solicitud_detalles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'solicitud_id',
        'item_id',
        'cantidad',
        'precio'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'solicitud_id' => 'integer',
        'item_id' => 'integer',
        'cantidad' => 'decimal:2',
        'precio' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'solicitud_id' => 'required',
        'item_id' => 'required',
        'cantidad' => 'required|numeric',
        'precio' => 'nullable|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id');
    }

    public function egreso()
    {

        if (!$this->item->inventariable)
            return null;

        $cantidad = $this->cantidad*-1;

        $stocks = $this->item->stocks
            ->where('cantidad','>',0)
            ->sortBy('orden_salida')
            ->sortBy('fecha_ven')
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

                $this->stocks()->syncWithoutDetaching([
                    $stock->id => ['cantidad' => $rebajado]
                ]);
            }

            if($cantidad>0)
                break;
        }

        $this->kardex()->create([
            'tienda_id' => $this->venta->tienda_id,
            'item_id' => $this->item->id,
            'cantidad' => $this->cantidad,
            'tipo' => Kardex::TIPO_SALIDA,
            'codigo' => $this->venta->codigo,
            'responsable' => $this->venta->cliente->full_name,
            'user_id' => auth()->user()->id ?? User::PRINCIPAL
        ]);

        return $stocks;

    }

    public function anular()
    {
        $this->kardex()->delete();

        /**
         * @var StockTransaccion $transacion
         */
        foreach ($this->transaccionesStock as $index => $transacion) {

            $transacion->revertir();

        }
    }
}
