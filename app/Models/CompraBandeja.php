<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property int $rol_id
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraRequicicionEstado> $compraRequicicionEstados
 * @property-read int|null $compra_requisicion_estados_count
 * @property-read \App\Models\Role $rol
 * @method static \Database\Factories\CompraBandejaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereRolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraBandeja withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraRequicicionEstado> $estados
 * @property-read int|null $estados_count
 * @mixin \Eloquent
 */
class CompraBandeja extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_bandejas';

    public $fillable = [
        'rol_id',
        'nombre',
        'descripcion'
    ];

    protected $casts = [
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    public static $rules = [
        'rol_id' => 'required',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function rol(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Role::class, 'rol_id');
    }

    public function estados(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\CompraRequicicionEstado::class,
            'compra_estado_has_bandeja',
            'bandeja_id',
            'estado_id'
        );
    }
}
