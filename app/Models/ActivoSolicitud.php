<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ActivoSolicitud
 * @package App\Models
 * @version November 12, 2022, 10:29 am CST
 *
 * @property \App\Models\RrhhUnidad $unidadOrigen
 * @property \App\Models\User $usuarioAutoriza
 * @property \App\Models\ActivoSolicitudEstado $estado
 * @property \App\Models\RrhhColaborador $colaboradorDestino
 * @property \App\Models\RrhhUnidad $unidadDestino
 * @property \App\Models\User $usuarioInventario
 * @property \App\Models\RrhhColaborador $colaboradorOrigen
 * @property \Illuminate\Database\Eloquent\Collection $detalles
 * @property integer $colaborador_origen
 * @property integer $unidad_origen
 * @property integer $colaborador_destino
 * @property integer $unidad_destino
 * @property string $codigo
 * @property integer $correlativo
 * @property integer $usuario_autoriza
 * @property integer $usuario_inventario
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
        'colaborador_origen',
        'unidad_origen',
        'colaborador_destino',
        'unidad_destino',
        'codigo',
        'correlativo',
        'usuario_autoriza',
        'usuario_inventario',
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
        'colaborador_origen' => 'integer',
        'unidad_origen' => 'integer',
        'colaborador_destino' => 'integer',
        'unidad_destino' => 'integer',
        'codigo' => 'string',
        'correlativo' => 'integer',
        'usuario_autoriza' => 'integer',
        'usuario_inventario' => 'integer',
        'observaciones' => 'string',
        'estado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'colaborador_origen' => 'nullable',
        'unidad_origen' => 'nullable',
        'colaborador_destino' => 'nullable',
        'unidad_destino' => 'nullable',
        'codigo' => 'nullable|string|max:45',
        'correlativo' => 'nullable|integer',
        'usuario_autoriza' => 'nullable',
        'usuario_inventario' => 'nullable',
        'observaciones' => 'nullable|string',
        'estado_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidadOrigen()
    {
        return $this->belongsTo(\App\Models\RrhhUnidad::class, 'unidad_origen');
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
    public function estado()
    {
        return $this->belongsTo(\App\Models\ActivoSolicitudEstado::class, 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function colaboradorDestino()
    {
        return $this->belongsTo(\App\Models\RrhhColaborador::class, 'colaborador_destino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidadDestino()
    {
        return $this->belongsTo(\App\Models\RrhhUnidad::class, 'unidad_destino');
    }

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
    public function colaboradorOrigen()
    {
        return $this->belongsTo(\App\Models\RrhhColaborador::class, 'colaborador_origen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function detalles()
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

        $q->where('usuario_autoriza', $user->id);
    }

    public function anular()
    {
        $this->estado_id = ActivoSolicitudEstado::ANULADA;
        $this->save();
    }

}
