<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Unimed
 *
 * @property int $id
 * @property int $magnitud_id
 * @property string $simbolo
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Magnitud $magnitud
 * @method static \Database\Factories\UnimedFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed query()
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereMagnitudId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereSimbolo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Unimed withoutTrashed()
 * @mixin \Eloquent
 */
class Unimed extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'unimeds';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'magnitud_id',
        'simbolo',
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'magnitud_id' => 'integer',
        'simbolo' => 'string',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'magnitud_id' => 'required',
        'simbolo' => 'required|string|max:10',
        'nombre' => 'required|string|max:45',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function magnitud()
    {
        return $this->belongsTo(\App\Models\Magnitud::class, 'magnitud_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function items()
    {
        return $this->hasMany(\App\Models\Item::class, 'unimed_id');
    }
}
