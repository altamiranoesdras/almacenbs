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
 * @property-read string $color
 * @method static \Database\Factories\CompraSolicitudEstadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CompraSolicitudEstado withoutTrashed()
 * @mixin \Eloquent
 */
class CompraSolicitudEstado extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'compra_solicitud_estados';

    const CREADA_CONSOLIDACION_SOLICITUDES = 1;
    const EVALUANDO_PROVEEDORES_PROCESO_COMPETITIVO = 2;
    const CUADRO_COMPARATIVO_GENERADO = 3;
    const ACTA_NEGOCIACION_GENERADA_FIRMAS_ELECTRONICAS = 4;
    const ACTA_NEGOCIACION_AUTORIZADA = 5;
    const ADJUDICADA = 6;
    const ORDEN_COMPRA_GENERADA = 7;
    const FINALIZADA = 8;
    const CANCELADA = 9;


    public $fillable = [
        'nombre'
    ];

    protected $casts = [
        'nombre' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|string|max:50',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

//    public function compraSolicitudes(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany(\App\Models\CompraSolicitude::class, 'estado_id');
//    }

    /**
     * Get the color attribute based on the state ID.
     * @return string
     */
    public function getColorAttribute(): string
    {

        switch ($this->id) {
            case self::CREADA_CONSOLIDACION_SOLICITUDES:
                return "info";
            case self::EVALUANDO_PROVEEDORES_PROCESO_COMPETITIVO:
                return "primary";
            case self::CANCELADA:
                return "danger";
            case self::ACTA_NEGOCIACION_GENERADA_FIRMAS_ELECTRONICAS:
                return "warning";
            default:
                return "secondary";
        }

    }
}
