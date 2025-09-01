<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CompraEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra> $compras
 * @property-read int|null $compras_count
 * @method static \Database\Factories\CompraEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraEstado withoutTrashed()
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
    const PROCESADO_PENDIENTE_RECIBIR =     2;

    const INGRESADO =   3;

    const UNO_H_OPERADO                    = 4;
    const UNO_H_APROBADO                   = 5;
    const UNO_H_AUTORIZADO                 = 6;
    const RETORNO_POR_APROBADOR            = 7;
    const RETORNO_POR_AUTORIZADOR          = 8;
    const CANCELADO =  9;

    const ANULADO =    10;




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
