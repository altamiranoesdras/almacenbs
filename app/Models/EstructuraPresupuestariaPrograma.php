<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EstructuraPresupuestariaSubprograma> $estructuraPresupuestariaSubprogramas
 * @property-read int|null $estructura_presupuestaria_subprogramas_count
 * @method static \Database\Factories\EstructuraPresupuestariaProgramaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaPrograma newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaPrograma newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaPrograma onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaPrograma query()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaPrograma whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaPrograma whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaPrograma whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaPrograma whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaPrograma whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaPrograma whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaPrograma whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaPrograma withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EstructuraPresupuestariaPrograma withoutTrashed()
 * @mixin \Eloquent
 */
class EstructuraPresupuestariaPrograma extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'estructura_presupuestaria_programas';

    public $fillable = [
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
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function estructuraPresupuestariaSubprogramas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\EstructuraPresupuestariaSubprograma::class, 'programa_id');
    }
}
