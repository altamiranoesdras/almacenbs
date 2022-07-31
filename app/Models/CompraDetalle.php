<?php

namespace App\Models;

use App\Traits\UseStockTransaccion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CompraDetalle
 * @package App\Models
 * @version July 27, 2022, 12:22 pm CST
 *
 * @property \App\Models\Compra $compra
 * @property \App\Models\Item $item
 * @property integer $compra_id
 * @property integer $item_id
 * @property number $cantidad
 * @property number $precio
 * @property number $descuento
 * @property string $fecha_ven
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
        'fecha_ven'
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
        'precio' => 'decimal:2',
        'descuento' => 'decimal:2',
        'fecha_ven' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'compra_id' => 'required',
        'item_id' => 'required',
        'cantidad' => 'required|numeric',
        'precio' => 'required|numeric',
        'descuento' => 'nullable|numeric',
        'fecha_ven' => 'nullable',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function compra()
    {
        return $this->belongsTo(\App\Models\Compra::class, 'compra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
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
        $stock =  $this->item->stocks->where('item_id',$this->id)
            ->where('tienda_id',$this->compra->tienda_id)
            ->where('fecha_ven',$this->fecha_ven)
            ->sortBy('orden_salida')
            ->sortBy('fecha_ven')
            ->sortBy('created_at')
            ->sortBy('id')
            ->first();

        if($stock){

            $stock->cantidad += $this->cantidad;
            $stock->save();

        }else{

            $stock= Stock::create([
                'tienda_id' => $this->compra->tienda_id,
                'item_id' => $this->item->id,
                'lote' =>  null,
                'fecha_ven' => $this->fecha_ven,
                'cantidad' =>  $this->cantidad,
                'cantidad_inicial' =>  $this->cantidad,
                'orden_salida' => 0
            ]);

        }

        $this->kardex()->create([
            'tienda_id' => $this->compra->tienda_id,
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
