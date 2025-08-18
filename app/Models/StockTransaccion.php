<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class StockTransaccion
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property int $stock_id
 * @property string $tipo
 * @property string $cantidad
 * @property string $precio_costo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Stock $stock
 * @method static \Database\Factories\StockTransaccionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion wherePrecioCosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockTransaccion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StockTransaccion extends Model
{

    use HasFactory;

    public $table = 'stocks_transacciones';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const INGRESO = 'ingreso';
    const EGRESO = 'egreso';

    protected $dates = ['deleted_at'];



    public $fillable = [
        'model_type',
        'model_id',
        'stock_id',
        'tipo',
        'cantidad',
        'precio_costo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'model_type' => 'string',
        'model_id' => 'integer',
        'stock_id' => 'integer',
        'tipo' => 'string',
        'cantidad' => 'decimal:2',
        'precio_costo' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'model_type' => 'required|string|max:255',
        'model_id' => 'required',
        'stock_id' => 'required',
        'tipo' => 'required|string',
        'cantidad' => 'required|numeric',
        'precio_costo' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function stock()
    {
        return $this->belongsTo(\App\Models\Stock::class, 'stock_id');
    }

    public function revertir()
    {
        if ($this->tipo == self::EGRESO) {

            $this->stock->cantidad += $this->cantidad;

        }
        if ($this->tipo == self::INGRESO) {

            $this->stock->cantidad -= $this->cantidad;
        }

        $this->stock->save();
    }
}
