<?php

namespace App\Models\CompraRequisicion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $tipo_proceso
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraBandeja> $compraBandejas
 * @property-read int|null $compra_bandejas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraRequisicion\CompraRequisicion> $requisicion
 * @property-read int|null $requisicion_count
 * @method static \Database\Factories\CompraRequisicion\CompraRequisicionEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereTipoProceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraRequisicionEstado withoutTrashed()
 * @mixin \Eloquent
 */
class CompraRequisicionEstado extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_requisicion_estados';

	const NPG_CREADA_CONSOLIDACION_SOLICITUDES = 1;
	const NPG_EVALUANDO_PROVEEDORES = 2;
	const NPG_CUADRO_COMPARATIVO_GENERADO = 3;
	const NPG_ACTA_NEGOCIACION_GENERADA = 4;
	const NPG_ACTA_NEGOCIACION_AUTORIZADA = 5;
	const NPG_adjudicada = 6;
	const NPG_ORDEN_COMPRA_GENERADA = 7;
	const NPG_finalizada = 8;
	const NPG_cancelada = 9;
	const NOG_CREADA_CONSOLIDACION_SOLICITUDES = 10;
	const NOG_EVALUANDO_PROVEEDORES = 11;
	const NOG_CUADRO_COMPARATIVO_GENERADO = 12;
	const NOG_ACTA_NEGOCIACION_GENERADA = 13;
	const NOG_ACTA_NEGOCIACION_AUTORIZADA = 14;
	const NOG_adjudicada = 15;
	const NOG_ORDEN_COMPRA_GENERADA = 16;
	const NOG_finalizada = 17;
	const NOG_cancelada = 18;



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

    public function requisicion(): HasMany
    {
        return $this->hasMany(CompraRequisicion::class, 'estado_id');
    }
}
