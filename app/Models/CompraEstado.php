<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CompraEstado
 *
 * @package App\Models
 * @version July 27, 2022, 12:20 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $compras
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $compras_count
 * @method static \Database\Factories\CompraEstadoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado newQuery()
 * @method static \Illuminate\Database\Query\Builder|CompraEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CompraEstado withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CompraEstado withoutTrashed()
 * @mixin \Eloquent
 */
class CompraEstado extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'compra_estados';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    const TEMPORAL =   1;
    const CREADA =     2;
    const RECIBIDA =   3;
    const CANCELADA =  4;
    const ANULADA =    5;

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
        'nombre' => 'required|string|max:45',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function compras()
    {
        return $this->hasMany(\App\Models\Compra::class, 'estado_id');
    }
}
