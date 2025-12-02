<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $producto_id
 * @property string $codigo
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $partida_parcial
 * @property-read mixed $texto
 * @property-read \App\Models\RedProduccionProducto $producto
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RrhhUnidad> $rrhhUnidades
 * @property-read int|null $rrhh_unidades_count
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto deUnidad()
 * @method static \Database\Factories\RedProduccionSubProductoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto query()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto whereProductoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RedProduccionSubProducto withoutTrashed()
 * @mixin \Eloquent
 */
class RedProduccionSubProducto extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'red_produccion_sub_productos';

    protected $appends = [
        'texto'
    ];

    public $fillable = [
        'producto_id',
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
        'producto_id' => 'required',
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function producto(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\RedProduccionProducto::class, 'producto_id');
    }

    public function rrhhUnidades(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\RrhhUnidad::class,
            'red_produccion_subproducto_rrhh_unidad',
            'subproducto_id',
            'rrhh_unidad_id');
    }

    public function getTextoAttribute()
    {
        return $this->codigo . ' - ' . $this->nombre;
    }

    public function scopeDeUnidad()
    {
        return $this->whereHas('rrhhUnidades', function ($query) {
            $query->where('rrhh_unidades.id', usuarioAutenticado()->unidad_id);
        });

    }

    public function getPartidaParcialAttribute()
    {
        return $this->producto->partida_parcial;
    }
}
