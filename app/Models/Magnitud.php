<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Magnitud
 *
 * @package App\Models
 * @version July 27, 2022, 12:21 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $unimeds
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $unimeds_count
 * @method static \Database\Factories\MagnitudFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud newQuery()
 * @method static \Illuminate\Database\Query\Builder|Magnitud onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud query()
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Magnitud whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Magnitud withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Magnitud withoutTrashed()
 * @mixin \Eloquent
 */
class Magnitud extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'magnitudes';

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
        'nombre' => 'required|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function unimeds()
    {
        return $this->hasMany(\App\Models\Unimed::class, 'magnitud_id');
    }
}
