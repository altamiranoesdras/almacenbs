<?php

namespace App\Models;

use App\Traits\UseStockTransaccion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SolicitudDetalle
 *
 * @property int $id
 * @property int $solicitud_id
 * @property int $item_id
 * @property string $cantidad_solicitada
 * @property string $cantidad_aprobada
 * @property string $cantidad_despachada
 * @property string|null $precio
 * @property string|null $fecha_vence
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $sub_total
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Kardex> $kardexs
 * @property-read int|null $kardexs_count
 * @property-read \App\Models\Solicitud $solicitud
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockTransaccion> $transaccionesStock
 * @property-read int|null $transacciones_stock_count
 * @method static \Database\Factories\SolicitudDetalleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereCantidadAprobada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereCantidadDespachada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereCantidadSolicitada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereFechaVence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereSolicitudId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SolicitudDetalle withoutTrashed()
 * @property-read mixed $sub_total
 * @mixin \Eloquent
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
        'cantidad_solicitada',
        'cantidad_aprobada',
        'cantidad_despachada',
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
        'cantidad_solicitada' => 'required|numeric',
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

    public function kardex()
    {
        return $this->morphOne(Kardex::class,'model');
    }

    public function kardexs(): MorphMany
    {
        return $this->morphMany(Kardex::class,'model','model_type','model_id');
    }


    public function egreso()
    {

        // No ingresa stock si es servicio
        if($this->item->esServicio())
            return null;

        $cantidad = $this->cantidad_despachada*-1;

        $stocks = $this->item->stocks
            ->where('bodega_id',Bodega::PRINCIPAL)
            ->where('unidad_id',$this->solicitud->unidad_id)
            ->where('cantidad','>',0)
            ->sortBy('orden_salida')
            ->sortBy('fecha_vence')
            ->sortBy('created_at')
            ->sortBy('id');


        /**
         * @var Stock $primerStock
         */

        $primerStock = $stocks->first();

        /**
         * @var Stock $ultimoStock
         */

        $ultimoStock = $stocks->last();



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


                $this->kardex()->create([
                    'item_id' => $this->item->id,
                    'cantidad' => $rebajado,
                    'precio_movimiento' => $stock->precio_compra,
                    'precio_existencia' => $stock->precio_compra,
                    'tipo' => Kardex::TIPO_SALIDA,
                    'codigo' => $this->solicitud->codigo,
                    'responsable' => $this->solicitud->unidad->nombre,
                    'usuario_id' => auth()->user()->id ?? User::PRINCIPAL,
                    'folio_siguiente' => '',
                ]);
            }



            if($cantidad>0)
                break;
        }

//        $this->precio = $primerStock->precio_compra;
        $this->save();


        return $stocks;

    }

    public function ingreso($bodega)
    {

        // No ingresa stock si es servicio
        if($this->item->esServicio())
            return null;

        /**
         * @var Stock $stock
         */
        $stock =  $this->item->stocks
            ->where('bodega_id',$bodega)
            ->where('precio_compra',$this->precio)
            ->sortBy('orden_salida')
            ->sortBy('fecha_vence')
            ->sortBy('created_at')
            ->sortBy('id')
            ->first();


        if($stock){

            $stock->cantidad += $this->cantidad_despachada;
            $stock->save();

        }else{

            $stock= Stock::create([
                'bodega_id' => $bodega,
                'item_id' => $this->item->id,
                'lote' =>  null,
                'precio_compra' => $this->precio,
                'fecha_vence' => null,
                'cantidad' =>  $this->cantidad_despachada,
                'cantidad_inicial' =>  $this->cantidad_despachada,
                'orden_salida' => 0
            ]);

        }


        $this->addStockTransaccion(StockTransaccion::INGRESO,$stock->id,$this->cantidad_despachada,$this->precio);

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

    public function getSubTotalAttribute()
    {
        return $this->cantidad_despachada * $this->precio;

    }
}
