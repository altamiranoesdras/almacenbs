<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Bodega
 *
 * @property int $id
 * @property int|null $rrhh_unidade_id
 * @property string $nombre
 * @property string|null $direccion
 * @property string|null $telefono
 * @property int|null $unidad_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Stock> $stocks
 * @property-read int|null $stocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\BodegaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereRrhhUnidadeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bodega withoutTrashed()
 * @mixin \Eloquent
 */
class Bodega extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'bodegas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const PRINCIPAL =           1;
    const SANTIAGO_ATITLAN =    2;
    const IXCHIGUÁN =           3;
    const NEBAJ =               4;
    const SANTA_EULALIA =       5;
    const PLAYA_GRANDE =        6;

    protected $dates = ['deleted_at'];



    public $fillable = [
        'unidad_id',
        'nombre',
        'rrhh_unidade_id',
        'direccion',
        'telefono'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'direccion' => 'string',
        'telefono' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'direccion' => 'nullable|string',
        'telefono' => 'nullable|string|max:30',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stocks()
    {
        return $this->hasMany(\App\Models\Stock::class, 'bodega_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'bodega_id');
    }
}
