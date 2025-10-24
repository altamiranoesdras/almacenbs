<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $resultado_id
 * @property string $codigo
 * @property string $nombre
 * @property string|null $descripcion
 * @property int|null $actividad_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\EstructuraPresupuestariaActividad|null $actividad
 * @property-read \App\Models\RedProduccionResultado $resultado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RedProduccionSubProducto> $subProductos
 * @property-read int|null $sub_productos_count
 * @method static \Database\Factories\RedProduccionProductoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto query()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionProducto whereActividadId($value)
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
        'descripcion',
        'actividad_id'
    ];

    protected $casts = [
        'codigo' => 'string',
        'nombre' => 'string',
        'descripcion' => 'string',
        'actividad_id' => 'integer',
    ];

    public static $rules = [
        'resultado_id' => 'nullable',
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'actividad_id' => 'required|integer',

        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function resultado(): BelongsTo
    {
        return $this->belongsTo(\App\Models\RedProduccionResultado::class, 'resultado_id');
    }

//    public function actividades(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
//    {
//        return $this->belongsToMany(\App\Models\EstructuraPresupuestariaActividad::class,
//            'red_produccion_producto_actividad',
//            'producto_id',
//            'actividad_id'
//
//        );
//    }

    public function subProductos(): HasMany
    {
        return $this->hasMany(\App\Models\RedProduccionSubProducto::class, 'producto_id');
    }

    public function actividad(): BelongsTo
    {
        return $this->belongsTo(
            \App\Models\EstructuraPresupuestariaActividad::class,
            'actividad_id'
        );
    }
}
