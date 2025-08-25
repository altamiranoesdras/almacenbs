<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\CompraRequicicionTipoAdquisicionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionTipoAdquisicion withoutTrashed()
 * @mixin \Eloquent
 */
class CompraRequicicionTipoAdquisicion extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_requisicion_tipo_adquisiciones';

    public $fillable = [
        'nombre',
        'tipo_proceso'
    ];

    protected $casts = [
        'nombre' => 'string',
        'tipo_proceso' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:255',
        'tipo_proceso' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function compraRequisiciones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraRequisicione::class, 'ipo_adquisicion_id');
    }
}
