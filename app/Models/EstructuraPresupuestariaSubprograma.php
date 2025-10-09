<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $programa_id
 * @property string $codigo
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EstructuraPresupuestariaProyecto> $estructuraPresupuestariaProyectos
 * @property-read int|null $estructura_presupuestaria_proyectos_count
 * @property-read \App\Models\EstructuraPresupuestariaPrograma $programa
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RedProduccionResultado> $redProduccionResultados
 * @property-read int|null $red_produccion_resultados_count
 * @method static \Database\Factories\EstructuraPresupuestariaSubprogramaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma query()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma whereProgramaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaSubprograma withoutTrashed()
 * @mixin \Eloquent
 */
class EstructuraPresupuestariaSubprograma extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'estructura_presupuestaria_subprogramas';

    public $fillable = [
        'programa_id',
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
        'programa_id' => 'nullable',
        'codigo' => 'nullable|string|max:255',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function programa(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\EstructuraPresupuestariaPrograma::class, 'programa_id');
    }

    public function proyectos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\EstructuraPresupuestariaProyecto::class, 'subprograma_id');
    }

    public function redProduccionResultados(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\RedProduccionResultado::class, 'red_produccion_resultado_subprograma');
    }
}
