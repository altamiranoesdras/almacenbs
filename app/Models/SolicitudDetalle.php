<?php

namespace App\Models;

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
    use SoftDeletes;

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

    public function ingreso()
    {

        if(!$this->item->inventariable)
            return null;

        /**
         * @var Stock $stock
         */
        $stock =  $this->item->stocks->where('item_id',$this->id)
            ->where('fecha_vence',$this->fecha_ven)
            ->sortBy('orden_salida')
            ->sortBy('fecha_vence')
            ->sortBy('created_at')
            ->sortBy('id')
            ->first();

        if($stock){

            $stock->cantidad += $this->cantidad;
            $stock->save();

        }else{

            $stock= Stock::create([
                'item_id' => $this->item->id,
                'lote' =>  null,
                'fecha_vence' => $this->fecha_ven,
                'cantidad' =>  $this->cantidad,
                'cantidad_inicial' =>  $this->cantidad,
                'orden_salida' => 0
            ]);

        }

        $this->kardex()->create([
            'item_id' => $this->item->id,
            'cantidad' => $this->cantidad,
            'tipo' => Kardex::TIPO_INGRESO,
            'codigo' => $this->codigo,
            'responsable' => $this->respnsable,
            'usuario_id' => auth()->user()->id ?? User::PRINCIPAL
        ]);

        $this->addStockTransaccion(StockTransaccion::INGRESO,$stock->id,$this->cantidad,$this->precio);

        return $stock;
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
