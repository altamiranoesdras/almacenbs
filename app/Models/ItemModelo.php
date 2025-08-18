<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ItemModelo
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @method static \Database\Factories\ItemModeloFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemModelo withoutTrashed()
 * @mixin Model
 */
class ItemModelo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'item_modelos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


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
        return $this->hasMany(\App\Models\Item::class, 'modelo_id');
    }
}
