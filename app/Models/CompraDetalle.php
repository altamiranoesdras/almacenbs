<?php

namespace App\Models;

use App\Traits\UseStockTransaccion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CompraDetalle
 *
 * @package App\Models
 * @version July 27, 2022, 12:22 pm CST
 * @property Compra $compra
 * @property Item $item
 * @property integer $compra_id
 * @property integer $item_id
 * @property number $cantidad
 * @property number $precio
 * @property number $descuento
 * @property string $fecha_vence
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $codigo
 * @property-read mixed $responsable
 * @property-read mixed $sub_total
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stock[] $stocks
 * @property-read int|null $stocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StockTransaccion[] $transaccionesStock
 * @property-read int|null $transacciones_stock_count
 * @method static \Database\Factories\CompraDetalleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle newQuery()
 * @method static \Illuminate\Database\Query\Builder|CompraDetalle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereCompraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereDescuento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereFechaVence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraDetalle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CompraDetalle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CompraDetalle withoutTrashed()
 * @mixin \Eloquent
 */
class CompraDetalle extends Model
{
    use SoftDeletes,UseStockTransaccion;

    use HasFactory;

    public $table = 'compra_detalles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends =['sub_total'];

    public $fillable = [
        'compra_id',
        'item_id',
        'cantidad',
        'precio',
        'descuento',
        'fecha_vence'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'compra_id' => 'integer',
        'item_id' => 'integer',
        'cantidad' => 'decimal:2',
        'precio' => 'decimal:4',
        'descuento' => 'decimal:4',
        'fecha_vence' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'compra_id' => 'required',
        'item_id' => 'required',
        'cantidad' => 'required|numeric|min:1',
        'precio' => 'required|numeric',
        'descuento' => 'nullable|numeric',
        'fecha_vence' => 'nullable',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'ingresos')->withPivot('cantidad');
    }

    public function getSubTotalAttribute()
    {
        return $this->precio * $this->cantidad;
    }

    public function kardex()
    {
        return $this->morphOne(Kardex::class,'model');
    }

    public function getCodigoAttribute()
    {
        $codigo = $this->compra->codigo;

//        if ($this->compra->serie && $this->compra->numero){
//            $codigo = $this->compra->serie.' / '.$this->compra->numero;
//        }

        return $codigo;
    }

    public function getResponsableAttribute()
    {
        $codigo = $this->compra->proveedor->nombre;


        return $codigo;
    }

    public function ingreso()
    {

        if(!$this->item->inventariable)
            return null;

        /**
         * @var Stock $stock
         */
        $stock =  $this->item->stocks
            ->where('fecha_vence',$this->fecha_vence)
            ->where('bodega_id',Bodega::PRINCIPAL)
            ->where('precio_compra',$this->precio)
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
                'bodega_id' => Bodega::PRINCIPAL,
                'item_id' => $this->item->id,
                'lote' =>  null,
                'precio_compra' => $this->precio,
                'fecha_vence' => $this->fecha_vence,
                'cantidad' =>  $this->cantidad,
                'cantidad_inicial' =>  $this->cantidad,
                'orden_salida' => 0
            ]);

        }

        $this->addStockTransaccion(StockTransaccion::INGRESO,$stock->id,$this->cantidad,$this->precio);

        return $stock;
    }

    public function agregarKardex()
    {
        $this->kardex()->create([
            'item_id' => $this->item->id,
            'cantidad' => $this->cantidad,
            'tipo' => Kardex::TIPO_INGRESO,
            'codigo' => $this->compra->compra1h->id ?? $this->compra->orden_compra,
            'responsable' => $this->compra->proveedor->nombre,
            'usuario_id' => auth()->user()->id ?? User::PRINCIPAL
        ]);
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
