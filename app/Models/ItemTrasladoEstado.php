<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ItemTrasladoEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ItemTraslado> $itemsTraslados
 * @property-read int|null $items_traslados_count
 * @method static \Database\Factories\ItemTrasladoEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemTrasladoEstado withoutTrashed()
 * @mixin \Eloquent
 */
class ItemTrasladoEstado extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'items_traslados_estados';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const PROCESADO = 1;
    const ANULADO = 2;

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function itemsTraslados()
    {
        return $this->hasMany(\App\Models\ItemTraslado::class, 'estado_id');
    }
}
