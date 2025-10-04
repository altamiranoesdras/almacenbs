<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Proveedor
 *
 * @property int $id
 * @property string|null $nit
 * @property string $nombre
 * @property string|null $razon_social
 * @property string|null $correo
 * @property string|null $telefono_movil
 * @property string|null $telefono_oficina
 * @property string|null $direccion
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra> $compras
 * @property-read int|null $compras_count
 * @method static \Database\Factories\ProveedorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereRazonSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereTelefonoMovil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereTelefonoOficina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedor withoutTrashed()
 * @mixin \Eloquent
 */
class Proveedor extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'proveedores';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['texto'];

    public $fillable = [
        'nit',
        'nombre',
        'razon_social',
        'correo',
        'telefono_movil',
        'telefono_oficina',
        'direccion',
        'observaciones'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nit' => 'string',
        'nombre' => 'string',
        'razon_social' => 'string',
        'correo' => 'string',
        'telefono_movil' => 'string',
        'telefono_oficina' => 'string',
        'direccion' => 'string',
        'observaciones' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nit' => 'nullable|string|max:10',
        'nombre' => 'required|string|max:255',
        'razon_social' => 'nullable|string|max:255',
        'correo' => 'nullable|string|max:100',
        'telefono_movil' => 'nullable|string|max:8',
        'telefono_oficina' => 'nullable|string|max:8',
        'direccion' => 'nullable|string',
        'observaciones' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function compras()
    {
        return $this->hasMany(\App\Models\Compra::class, 'proveedor_id');
    }

    public function getTextoAttribute()
    {
        return $this->nombre . ' (' . $this->nit . ')';
    }
}
