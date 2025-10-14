<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SolicitudEstado
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $color
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Solicitud> $solicitudes
 * @property-read int|null $solicitudes_count
 * @method static \Database\Factories\SolicitudEstadoFactory factory($count = null, $state = [])
 * @method static Builder|SolicitudEstado newModelQuery()
 * @method static Builder|SolicitudEstado newQuery()
 * @method static Builder|SolicitudEstado onlyTrashed()
 * @method static Builder|SolicitudEstado principales()
 * @method static Builder|SolicitudEstado query()
 * @method static Builder|SolicitudEstado whereCreatedAt($value)
 * @method static Builder|SolicitudEstado whereDeletedAt($value)
 * @method static Builder|SolicitudEstado whereId($value)
 * @method static Builder|SolicitudEstado whereNombre($value)
 * @method static Builder|SolicitudEstado whereUpdatedAt($value)
 * @method static Builder|SolicitudEstado withTrashed()
 * @method static Builder|SolicitudEstado withoutTrashed()
 * @mixin \Eloquent
 */
class SolicitudEstado extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'solicitud_estados';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    const TEMPORAL =    1;
    const INGRESADA =   2;
    const SOLICITADA =  3;
    const AUTORIZADA =  4;
    const APROBADA =    5;
    const DESPACHADA =  6;
    const ANULADA =     7;
    const CANCELADA =   8;
    const RETORNO_POR_AUTORIZADOR  =   9;
    const RETORNO_POR_DESPACHO =   10;

    protected $dates = ['deleted_at'];


    protected $appends = ['color'];

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
        'nombre' => 'required|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudes()
    {
        return $this->hasMany(\App\Models\Solicitud::class, 'estado_id');
    }

    public function scopePrincipales(Builder $q)
    {
        $q->whereIn('id',[
            self::SOLICITADA,
            self::AUTORIZADA,
            self::APROBADA,
            self::DESPACHADA,
            self::ANULADA,
            self::RETORNO_POR_AUTORIZADOR,
            self::RETORNO_POR_DESPACHO,
        ]);
    }

    public function getColorAttribute()
    {

        switch ($this->id){
            case self::SOLICITADA:
                return "info";
            case self::APROBADA:
                return "primary";
            case self::DESPACHADA:
                return "success";
            case self::RETORNO_POR_DESPACHO:
            case self::RETORNO_POR_AUTORIZADOR:
                return "warning";
            default:
                return "secondary";
        }

    }
}
