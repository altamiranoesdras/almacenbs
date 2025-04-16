<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SolicitudEstado
 *
 * @package App\Models
 * @version July 27, 2022, 12:24 pm CST
 * @property \Illuminate\Database\Eloquent\Collection $solicitudes
 * @property string $color
 * @property string $nombre
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\SolicitudEstadoFactory factory(...$parameters)
 * @method static Builder|SolicitudEstado newModelQuery()
 * @method static Builder|SolicitudEstado newQuery()
 * @method static \Illuminate\Database\Query\Builder|SolicitudEstado onlyTrashed()
 * @method static Builder|SolicitudEstado principales()
 * @method static Builder|SolicitudEstado query()
 * @method static Builder|SolicitudEstado whereCreatedAt($value)
 * @method static Builder|SolicitudEstado whereDeletedAt($value)
 * @method static Builder|SolicitudEstado whereId($value)
 * @method static Builder|SolicitudEstado whereNombre($value)
 * @method static Builder|SolicitudEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|SolicitudEstado withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SolicitudEstado withoutTrashed()
 * @property-read int|null $solicitudes_count
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
    const RETORNO_SOLICITADA  =   9;
    const RETORNO_AUTORIZADA =   10;
    const RETORNO_APROBADA =   11;

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
        $q->whereIn('id',[self::SOLICITADA,self::AUTORIZADA,self::APROBADA,self::DESPACHADA,self::ANULADA]);
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
            case self::RETORNO_APROBADA:
            case self::RETORNO_AUTORIZADA:
            case self::RETORNO_SOLICITADA:
                return "warning";
            default:
                return "secondary";
        }

    }
}
