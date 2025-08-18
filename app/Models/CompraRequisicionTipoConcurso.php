<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\CompraRequisicionTipoConcursoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionTipoConcurso withoutTrashed()
 * @mixin \Eloquent
 */
class CompraRequisicionTipoConcurso extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_requisicion_tipo_concursos';

    public $fillable = [
        'nombre',
        'descripcion'
    ];

    protected $casts = [
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function compraRequisiciones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CompraRequisicione::class, 'tipo_concurso_id');
    }
}
