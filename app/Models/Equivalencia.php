<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Equivalencia
 *
 * @property int $id
 * @property int $item_origen
 * @property int $item_destino
 * @property string $cantidad
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Item $itemDestino
 * @property-read \App\Models\Item $itemOrigen
 * @method static \Database\Factories\EquivalenciaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia query()
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereItemDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereItemOrigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Equivalencia withoutTrashed()
 * @mixin \Eloquent
 */
class Equivalencia extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'equivalencias';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'item_origen',
        'item_destino',
        'cantidad'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'item_origen' => 'integer',
        'item_destino' => 'integer',
        'cantidad' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'item_origen' => 'required',
        'item_destino' => 'required',
        'cantidad' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function itemOrigen()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_origen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function itemDestino()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_destino');
    }
}
