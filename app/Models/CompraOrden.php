<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $gestion_id
 * @property int $proveedor_id
 * @property string $numero
 * @property \Illuminate\Support\Carbon $fecha
 * @property string $estado
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraOrdenDetalle> $compraOrdenDetalles
 * @property-read int|null $compra_orden_detalles_count
 * @method static \Database\Factories\CompraOrdenFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereGestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereProveedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraOrden withoutTrashed()
 * @mixin \Eloquent
 */
class CompraOrden extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_ordenes';

    public $fillable = [
        'gestion_id',
        'proveedor_id',
        'numero',
        'fecha',
        'estado',
        'observaciones'
    ];

    protected $casts = [
        'numero' => 'string',
        'fecha' => 'datetime',
        'estado' => 'string',
        'observaciones' => 'string'
    ];

    public static $rules = [
        'gestion_id' => 'required',
        'proveedor_id' => 'required',
        'numero' => 'required|string|max:50',
        'fecha' => 'required',
        'estado' => 'required|string',
        'observaciones' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function gestion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\CompraRequisicione::class, 'gestion_id');
    }

    public function proveedor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Proveedore::class, 'proveedor_id');
    }

    public function compraOrdenDetalles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraOrdenDetalle::class, 'orden_id');
    }
}
