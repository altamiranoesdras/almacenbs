<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $subprograma_id
 * @property string $codigo
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\EstructuraPresupuestariaSubprograma $subprograma
 * @method static \Database\Factories\EstructuraPresupuestariaProyectoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto query()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto whereSubprogramaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaProyecto withoutTrashed()
 * @mixin \Eloquent
 */
class EstructuraPresupuestariaProyecto extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'estructura_presupuestaria_proyectos';

    public $fillable = [
        'subprograma_id',
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
        'subprograma_id' => 'required',
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function subprograma(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\EstructuraPresupuestariaSubprograma::class, 'subprograma_id');
    }

    public function actividades(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\EstructuraPresupuestariaActividad::class, 'proyecto_id');
    }
}
