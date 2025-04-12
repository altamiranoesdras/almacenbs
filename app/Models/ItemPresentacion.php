<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ItemPresentacion
 *
 * @package App\Models
 * @version December 8, 2022, 10:59 am CST
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property string $codigo
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $items_count
 * @method static \Database\Factories\ItemPresentacionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion newQuery()
 * @method static \Illuminate\Database\Query\Builder|ItemPresentacion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemPresentacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ItemPresentacion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ItemPresentacion withoutTrashed()
 * @mixin Model
 */
class ItemPresentacion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'item_presentaciones';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'codigo',
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'codigo' => 'string',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required|string|max:255',
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
        return $this->hasMany(\App\Models\Item::class, 'presentacion_id');
    }
}
