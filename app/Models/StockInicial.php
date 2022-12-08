<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class StockInicial
 *
 * @package App\Models
 * @version July 27, 2022, 12:23 pm CST
 * @property \App\Models\Item $item
 * @property \App\Models\User $user
 * @property integer $item_id
 * @property number $cantidad
 * @property integer $user_id
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\StockInicialFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial newQuery()
 * @method static \Illuminate\Database\Query\Builder|StockInicial onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockInicial whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|StockInicial withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StockInicial withoutTrashed()
 * @mixin \Eloquent
 */
class StockInicial extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'stock_iniciales';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'item_id',
        'cantidad',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'item_id' => 'integer',
        'cantidad' => 'decimal:4',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'item_id' => 'required',
        'cantidad' => 'required|numeric',
        'user_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
