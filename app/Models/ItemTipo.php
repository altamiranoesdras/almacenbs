<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ItemTipo
 *
 * @package App\Models
 * @version August 4, 2022, 7:00 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $items_count
 * @method static \Database\Factories\ItemTipoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo newQuery()
 * @method static \Illuminate\Database\Query\Builder|ItemTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ItemTipo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ItemTipo withoutTrashed()
 * @mixin \Eloquent
 */
class ItemTipo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'item_tipos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const ACTIVO_FIJO = 1;
    const FUNGIBLE = 2;
    const MATERIALES_SUMINISTROS = 3;
    const SERVICIOS = 4;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function items()
    {
        return $this->hasMany(\App\Models\Item::class, 'tipo_id');
    }
}
