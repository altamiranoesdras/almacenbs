<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraBandeja> $compraBandejas
 * @property-read int|null $compra_bandejas_count
 * @method static \Database\Factories\CompraRequicicionEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequicicionEstado withoutTrashed()
 * @mixin \Eloquent
 */
class CompraRequicicionEstado extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_requisicion_estados';

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
        'tipo_proceso' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function compraBandejas(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\CompraBandeja::class, 'compra_estado_has_bandeja');
    }

    public function compraRequisiciones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraRequisicione::class, 'estado_id');
    }
}
