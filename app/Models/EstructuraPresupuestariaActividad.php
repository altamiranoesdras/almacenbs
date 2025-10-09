<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $proyecto_id
 * @property string $codigo
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\EstructuraPresupuestariaProyecto $proyecto
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RedProduccionProducto> $redProduccionProductos
 * @property-read int|null $red_produccion_productos_count
 * @method static \Database\Factories\EstructuraPresupuestariaActividadFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad query()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad whereProyectoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaActividad withoutTrashed()
 * @mixin \Eloquent
 */
class EstructuraPresupuestariaActividad extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'estructura_presupuestaria_actividades';

    public $fillable = [
        'proyecto_id',
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
        'proyecto_id' => 'required',
        'codigo' => 'nullable|string|max:255',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function proyecto(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\EstructuraPresupuestariaProyecto::class, 'proyecto_id');
    }

    public function redProduccionProductos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\RedProduccionProducto::class, 'red_produccion_producto_actividad');
    }
}
