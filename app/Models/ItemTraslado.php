<?php

namespace App\Models;

use App\Traits\UseStockTransaccion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ItemTraslado
 *
 * @property int $id
 * @property string $codigo
 * @property int $correlativo
 * @property int $item_origen
 * @property string|null $cantidad_origen
 * @property int $item_destino
 * @property string|null $cantidad_destino
 * @property string|null $observaciones
 * @property int $user_id
 * @property int $estado_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\ItemTrasladoEstado $estado
 * @property-read \App\Models\Item $itemDestino
 * @property-read \App\Models\Item $itemOrigen
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockTransaccion> $transaccionesStock
 * @property-read int|null $transacciones_stock_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ItemTrasladoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereCantidadDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereCantidadOrigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereItemDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereItemOrigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTraslado withoutTrashed()
 * @mixin \Eloquent
 */
class ItemTraslado extends Model
{
    use SoftDeletes;

    use HasFactory;
    use UseStockTransaccion;

    public $table = 'items_traslados';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'codigo',
        'correlativo',
        'item_origen',
        'cantidad_origen',
        'item_destino',
        'cantidad_destino',
        'observaciones',
        'user_id',
        'estado_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'codigo' => 'string',
        'correlativo' => 'integer',
        'item_origen' => 'integer',
        'cantidad_origen' => 'decimal:2',
        'item_destino' => 'integer',
        'cantidad_destino' => 'decimal:2',
        'observaciones' => 'string',
        'user_id' => 'integer',
        'estado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'item_origen' => 'required',
        'cantidad_origen' => 'required|numeric',
        'item_destino' => 'required',
        'cantidad_destino' => 'required|numeric',
        'observaciones' => 'nullable|string',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(\App\Models\ItemTrasladoEstado::class, 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function itemDestino()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_destino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function itemOrigen()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_origen');
    }


    public function kardex()
    {
        return $this->morphOne(Kardex::class,'model');
    }

    public function procesarEgreso()
    {

        if (!$this->itemOrigen->inventariable)
            throw new  \Exception("El articulo ".$this->itemOrigen->text." no es inventariable");


        $cantidad = $this->cantidad_origen*-1;

        $stocks = $this->itemOrigen->stocks
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

                $this->addStockTransaccion(StockTransaccion::EGRESO,$stock->id,$this->cantidad_origen,$this->itemOrigen->precio_compra);
            }

            if($cantidad>0)
                break;
        }

        $this->kardex()->create([
            'item_id' => $this->itemOrigen->id,
            'cantidad' => $this->cantidad_origen,
            'tipo' => Kardex::TIPO_SALIDA,
            'codigo' => $this->codigo,
            'responsable' => "Traslado a articulo: ".$this->itemDestino->text,
            'usuario_id' => auth()->user()->id
        ]);

        return $stocks;

    }

    public function procesarIngreso()
    {
        if (!$this->itemDestino->inventariable)
            throw new  \Exception("El articulo ".$this->itemDestino->text." no es inventariable");

        /**
         * @var Stock $stock
         */
        $stock =  $this->itemDestino->stocks
            ->sortBy('orden_salida')
            ->sortBy('fecha_vence')
            ->sortBy('created_at')
            ->sortBy('id')
            ->first();

        if($stock){

            $stock->cantidad += $this->cantidad_destino;
            $stock->save();

        }else{

            $stock= Stock::create([
                'item_id' => $this->itemDestino->id,
                'lote' =>  null,
                'fecha_vence' => null,
                'cantidad' =>  $this->cantidad_destino,
                'cnt_ini' =>  $this->cantidad_destino,
                'orden_salida' => 0
            ]);

        }

        $this->kardex()->create([
            'item_id' => $this->itemDestino->id,
            'cantidad' => $this->cantidad_destino,
            'tipo' => Kardex::TIPO_INGRESO,
            'codigo' => $this->codigo,
            'responsable' => "Traslado desde articulo: ".$this->itemDestino->text,
            'usuario_id' => auth()->user()->id
        ]);

        $this->addStockTransaccion(StockTransaccion::INGRESO,$stock->id,$this->cantidad_destino,$this->itemDestino->precio_compra);

        return $stock;
    }


    public function puedeAnular()
    {
        return $this->estado_id != \App\Models\ItemTrasladoEstado::ANULADO && $this->estado_id == \App\Models\ItemTrasladoEstado::PROCESADO;
    }

    public function anular()
    {
        $this->estado_id = ItemTrasladoEstado::ANULADO;
        $this->save();

        $this->kardex()->delete();

        /**
         * @var StockTransaccion $transacion
         */
        foreach ($this->transaccionesStock as $index => $transacion) {

            $transacion->revertir();

        }

    }
}
