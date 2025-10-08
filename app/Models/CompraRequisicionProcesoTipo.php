<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraRequisicionEstado> $compraRequisicionEstados
 * @property-read int|null $compra_requisicion_estados_count
 * @method static \Database\Factories\CompraRequisicionProcesoTipoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionProcesoTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionProcesoTipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionProcesoTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionProcesoTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionProcesoTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionProcesoTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionProcesoTipo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionProcesoTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionProcesoTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionProcesoTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionProcesoTipo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionProcesoTipo withoutTrashed()
 * @mixin \Eloquent
 */
class CompraRequisicionProcesoTipo extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_requisicion_proceso_tipos';

    public $fillable = [
        'nombre',
        'descripcion'
    ];

    protected $casts = [
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function compraRequisicionEstados(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\CompraRequisicionEstado::class, 'compra_requisicion_proceso_has_estado');
    }

    public function compraRequisicionTipoAdquisiciones(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\CompraRequisicionTipoAdquisicione::class, 'compra_requisicion_tipo_adquisicion_has_proceso');
    }
}
