<?php

namespace App\Models;

use App\Models\CompraRequisicion\CompraRequisicion;
use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraRequisicionProcesoTipo> $compraRequisicionProcesoTipos
 * @property-read int|null $compra_requisicion_proceso_tipos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, CompraRequisicion> $compraRequisiciones
 * @property-read int|null $compra_requisiciones_count
 * @method static \Database\Factories\CompraRequisicionTipoAdquisicionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoAdquisicion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoAdquisicion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoAdquisicion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoAdquisicion query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoAdquisicion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoAdquisicion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoAdquisicion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoAdquisicion whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoAdquisicion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoAdquisicion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoAdquisicion withoutTrashed()
 * @mixin \Eloquent
 */
class CompraRequisicionTipoAdquisicion extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_requisicion_tipo_adquisiciones';

    public $fillable = [
        'nombre'
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function compraRequisicionProcesoTipos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\CompraRequisicionProcesoTipo::class, 'compra_requisicion_tipo_adquisicion_has_proceso');
    }

    public function compraRequisiciones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CompraRequisicion::class, 'tipo_adquisicion_id');
    }
}
