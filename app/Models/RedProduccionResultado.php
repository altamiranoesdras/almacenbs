<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RedProduccionProducto> $productos
 * @property-read int|null $productos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EstructuraPresupuestariaSubprograma> $subProgramas
 * @property-read int|null $sub_programas_count
 * @method static \Database\Factories\RedProduccionResultadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionResultado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionResultado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionResultado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionResultado query()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionResultado whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionResultado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionResultado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionResultado whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionResultado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionResultado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionResultado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionResultado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionResultado withoutTrashed()
 * @mixin \Eloquent
 */
class RedProduccionResultado extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'red_produccion_resultados';

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
        'codigo' => 'nullable|string|max:255',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function productos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\RedProduccionProducto::class, 'resultado_id');
    }

    public function subProgramas(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\EstructuraPresupuestariaSubprograma::class, 'red_produccion_resultado_subprograma');
    }
}
