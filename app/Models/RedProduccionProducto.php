<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $resultado_id
 * @property string $codigo
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RedProduccionSubProducto> $redProduccionSubProductos
 * @property-read int|null $red_produccion_sub_productos_count
 * @property-read \App\Models\RedProduccionResultado $resultado
 * @method static \Database\Factories\RedProduccionProductoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto query()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto whereResultadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto withoutTrashed()
 * @mixin \Eloquent
 */
class RedProduccionProducto extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'red_produccion_productos';

    public $fillable = [
        'resultado_id',
        'codigo',
        'nombre',
        'descripcion'
    ];

    protected $casts = [
        'codigo' => 'string',
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    public static $rules = [
        'resultado_id' => 'nullable',
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function resultado(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\RedProduccionResultado::class, 'resultado_id');
    }

    public function actividades(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\EstructuraPresupuestariaActividad::class, 'red_produccion_producto_actividad');
    }

    public function subProductos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\RedProduccionSubProducto::class, 'producto_id');
    }
}
