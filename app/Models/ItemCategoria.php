<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ItemCategoria
 *
 * @package App\Models
 * @version July 27, 2022, 12:21 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property \Illuminate\Database\Eloquent\Collection $item1s
 * @property string $nombre
 * @property string $descripcion
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $item1s_count
 * @property-read int|null $items_count
 * @method static \Database\Factories\ItemCategoriaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria newQuery()
 * @method static \Illuminate\Database\Query\Builder|ItemCategoria onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategoria whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ItemCategoria withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ItemCategoria withoutTrashed()
 * @mixin \Eloquent
 */
class ItemCategoria extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'item_categorias';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:45',
        'descripcion' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function items()
    {
        return $this->belongsToMany(\App\Models\Item::class, 'item_has_categoria');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function item1s()
    {
        return $this->hasMany(\App\Models\Item::class, 'categoria_id');
    }
}
