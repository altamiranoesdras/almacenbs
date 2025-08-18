<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Renglon
 *
 * @property int $id
 * @property string $numero
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $text
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @method static \Database\Factories\RenglonFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Renglon withoutTrashed()
 * @mixin \Eloquent
 */
class Renglon extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'renglones';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    protected $appends = ['text'];

    public $fillable = [
        'numero',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'numero' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'numero' => 'required|string',
        'descripcion' => 'nullable|string',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function items()
    {
        return $this->hasMany(\App\Models\Item::class, 'renglon_id');
    }

    public function getTextAttribute()
    {
        return $this->numero." - ".str_limit($this->descripcion,50);
    }
}
