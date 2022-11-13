<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoSolicitud
 * @package App\Models
 * @version August 31, 2022, 10:52 pm CST
 *
 * @property \App\Models\User $usuarioInventario
 * @property \App\Models\RrhhUnidade $unidadOrigen
 * @property \App\Models\User $usuarioOrigen
 * @property \App\Models\ActivoSolicitudEstado $estado
 * @property \App\Models\User $usuarioAutoriza
 * @property \App\Models\ActivoTarjeta $tarjeta
 * @property \App\Models\RrhhUnidade $unidadDestino
 * @property \App\Models\User $usuarioDestino
 * @property \App\Models\ActivoSolicitudTipo $tipo
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudDetalles
 * @property integer $tarjeta_id
 * @property integer $tipo_id
 * @property string $codigo
 * @property integer $correlativo
 * @property integer $usuario_origen
 * @property integer $usuario_destino
 * @property integer $usuario_autoriza
 * @property integer $usuario_inventario
 * @property integer $unidad_origen
 * @property integer $unidad_destino
 * @property string $observaciones
 * @property integer $estado_id
 */
class ActivoSolicitud extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'activo_solicitudes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'tarjeta_id',
        'tipo_id',
        'codigo',
        'correlativo',
        'usuario_origen',
        'usuario_destino',
        'usuario_autoriza',
        'usuario_inventario',
        'unidad_origen',
        'unidad_destino',
        'observaciones',
        'estado_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tarjeta_id' => 'integer',
        'tipo_id' => 'integer',
        'codigo' => 'string',
        'correlativo' => 'integer',
        'usuario_origen' => 'integer',
        'usuario_destino' => 'integer',
        'usuario_autoriza' => 'integer',
        'usuario_inventario' => 'integer',
        'unidad_origen' => 'integer',
        'unidad_destino' => 'integer',
        'observaciones' => 'string',
        'estado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tarjeta_id' => 'required',
        'tipo_id' => 'nullable',
        'codigo' => 'nullable|string|max:45',
        'correlativo' => 'nullable|integer',
        'usuario_origen' => 'required',
        'usuario_destino' => 'nullable',
        'usuario_autoriza' => 'nullable',
        'usuario_inventario' => 'nullable',
        'unidad_origen' => 'required',
        'unidad_destino' => 'required',
        'observaciones' => 'nullable|string',
        'estado_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioInventario()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_inventario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidadOrigen()
    {
        return $this->belongsTo(\App\Models\RrhhUnidade::class, 'unidad_origen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioOrigen()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_origen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(\App\Models\ActivoSolicitudEstado::class, 'estado_id');
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
    public function tarjeta()
    {
        return $this->belongsTo(\App\Models\ActivoTarjeta::class, 'tarjeta_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidadDestino()
    {
        return $this->belongsTo(\App\Models\RrhhUnidade::class, 'unidad_destino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioDestino()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_destino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipo()
    {
        return $this->belongsTo(\App\Models\ActivoSolicitudTipo::class, 'tipo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activoSolicitudDetalles()
    {
        return $this->hasMany(\App\Models\ActivoSolicitudDetalle::class, 'solicitud_id');
    }

    /**
     * @Scope
     */
    public function scopeTemporal($q)
    {
        $q->where('estado_id', ActivoSolicitudEstado::TEMPORAL);
    }

    public function scopeDelUsuarioCrea($q, $user = null)
    {
        $user = $user ?? auth()->user() ?? auth('api')->user();

        $q->where('usuario_inventario', $user->id);
    }

}
