<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Solicitud
 * @package App\Models
 * @version July 27, 2022, 12:25 pm CST
 *
 * @property \App\Models\User $usuarioDespacha
 * @property \App\Models\User $usuarioSolicita
 * @property \App\Models\SolicitudEstado $estado
 * @property \App\Models\User $usuarioCrea
 * @property \App\Models\User $usuarioAutoriza
 * @property \App\Models\User $usuarioAprueba
 * @property \App\Models\RrhhUnidad $unidad
 * @property \Illuminate\Database\Eloquent\Collection $detalles
 * @property string $codigo
 * @property integer $correlativo
 * @property string $justificacion
 * @property integer $unidad_id
 * @property integer $usuario_crea
 * @property integer $usuario_solicita
 * @property integer $usuario_autoriza
 * @property integer $usuario_aprueba
 * @property integer $usuario_despacha
 * @property string $firma_requiere
 * @property string $firma_autoriza
 * @property string $firma_aprueba
 * @property string $firma_almacen
 * @property string|\Carbon\Carbon $fecha_solicita
 * @property string|\Carbon\Carbon $fecha_autoriza
 * @property string|\Carbon\Carbon $fecha_aprueba
 * @property string|\Carbon\Carbon $fecha_almacen_firma
 * @property string|\Carbon\Carbon $fecha_informa
 * @property string|\Carbon\Carbon $fecha_despacha
 * @property integer $estado_id
 */
class Solicitud extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'solicitudes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected static function booted()
    {
        static::addGlobalScope('noTemporal', function (Builder $builder) {
            $builder->where('estado_id', '!=', SolicitudEstado::TEMPORAL);
        });
    }


    public $fillable = [
        'codigo',
        'correlativo',
        'justificacion',
        'unidad_id',
        'usuario_crea',
        'usuario_solicita',
        'usuario_autoriza',
        'usuario_aprueba',
        'usuario_despacha',
        'firma_requiere',
        'firma_autoriza',
        'firma_aprueba',
        'firma_almacen',
        'fecha_solicita',
        'fecha_autoriza',
        'fecha_aprueba',
        'fecha_almacen_firma',
        'fecha_informa',
        'fecha_despacha',
        'estado_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'codigo' => 'string',
        'correlativo' => 'integer',
        'justificacion' => 'string',
        'unidad_id' => 'integer',
        'usuario_crea' => 'integer',
        'usuario_solicita' => 'integer',
        'usuario_autoriza' => 'integer',
        'usuario_aprueba' => 'integer',
        'usuario_despacha' => 'integer',
        'firma_requiere' => 'string',
        'firma_autoriza' => 'string',
        'firma_aprueba' => 'string',
        'firma_almacen' => 'string',
        'fecha_solicita' => 'datetime',
        'fecha_autoriza' => 'datetime',
        'fecha_aprueba' => 'datetime',
        'fecha_almacen_firma' => 'datetime',
        'fecha_informa' => 'datetime',
        'fecha_despacha' => 'datetime',
        'estado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'nullable|string|max:255',
        'correlativo' => 'nullable|integer',
        'justificacion' => 'required|string',
        'unidad_id' => 'nullable',
        'usuario_crea' => 'nullable',
        'usuario_solicita' => 'nullable',
        'usuario_autoriza' => 'nullable',
        'usuario_aprueba' => 'nullable',
        'usuario_despacha' => 'nullable',
        'firma_requiere' => 'nullable|string|max:255',
        'firma_autoriza' => 'nullable|string|max:255',
        'firma_aprueba' => 'nullable|string|max:255',
        'firma_almacen' => 'nullable|string|max:255',
        'fecha_solicita' => 'nullable',
        'fecha_autoriza' => 'nullable',
        'fecha_aprueba' => 'nullable',
        'fecha_almacen_firma' => 'nullable',
        'fecha_informa' => 'nullable',
        'fecha_despacha' => 'nullable',
        'estado_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioDespacha()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_despacha');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioSolicita()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_solicita');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(\App\Models\SolicitudEstado::class, 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioCrea()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_crea');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioAutoriza()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_autoriza');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioAprueba()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_aprueba');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidad()
    {
        return $this->belongsTo(\App\Models\RrhhUnidade::class, 'unidad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function detalles()
    {
        return $this->hasMany(\App\Models\SolicitudDetalle::class, 'solicitud_id');
    }

    public function scopeTemporal(Builder $q)
    {
        $q->withoutGlobalScope('noTemporal')->where('estado_id',SolicitudEstado::TEMPORAL);
    }

    public function scopeDelUsuarioCrea($q,$user=null)
    {
        $user = $user ?? auth()->user() ?? auth('api')->user();


        $q->where('usuario_crea',$user->id);
    }

    public function esTemporal()
    {
        return $this->estado_id==SolicitudEstado::TEMPORAL;
    }

    public function puedeEditar()
    {
        return $this->estado_id==SolicitudEstado::TEMPORAL || $this->estado_id==SolicitudEstado::INGRESADA;
    }

    public function puedeSolicitar()
    {
        return $this->estado_id==SolicitudEstado::INGRESADA;
    }

    public function puedeAutorizar()
    {
        return $this->estado_id == SolicitudEstado::SOLICITADA;
    }

    public function puedeDespachar()
    {
        return $this->estado_id == SolicitudEstado::APROBADA;
    }

    public function puedeAnular()
    {
        return $this->estado_id != SolicitudEstado::ANULADA && $this->estado_id == SolicitudEstado::DESPACHADA;
    }
}
