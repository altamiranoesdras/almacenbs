<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Activo
 * @package App\Models
 * @version August 31, 2022, 10:51 pm CST
 *
 * @property \App\Models\ActivoEstado $estado
 * @property \App\Models\Compra1hDetalle $detalle1h
 * @property \App\Models\ActivoTipo $tipo
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property \Illuminate\Database\Eloquent\Collection $activoSolicitudDetalles
 * @property \Illuminate\Database\Eloquent\Collection $activoTarjetaDetalles
 * @property string $codigo_inventario
 * @property string $folio
 * @property string $descripcion
 * @property number $valor
 * @property string $fecha_registra
 * @property integer $tipo_id
 * @property integer $detalle_1h_id
 * @property integer $estado_id
 */
class Activo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'activos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'codigo_inventario',
        'folio',
        'descripcion',
        'valor',
        'fecha_registra',
        'tipo_id',
        'detalle_1h_id',
        'estado_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'codigo_inventario' => 'string',
        'folio' => 'string',
        'descripcion' => 'string',
        'valor' => 'decimal:2',
        'fecha_registra' => 'date',
        'tipo_id' => 'integer',
        'detalle_1h_id' => 'integer',
        'estado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo_inventario' => 'required|string|max:100',
        'folio' => 'nullable|string|max:100',
        'descripcion' => 'required|string',
        'valor' => 'nullable|numeric',
        'fecha_registra' => 'required',
        'tipo_id' => 'required',
        'detalle_1h_id' => 'nullable',
        'estado_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(\App\Models\ActivoEstado::class, 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function detalle1h()
    {
        return $this->belongsTo(\App\Models\Compra1hDetalle::class, 'detalle_1h_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipo()
    {
        return $this->belongsTo(\App\Models\ActivoTipo::class, 'tipo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function items()
    {
        return $this->belongsToMany(\App\Models\Item::class, 'activo_item');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activoSolicitudDetalles()
    {
        return $this->hasMany(\App\Models\ActivoSolicitudDetalle::class, 'activo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activoTarjetaDetalles()
    {
        return $this->hasMany(\App\Models\ActivoTarjetaDetalle::class, 'activo_id');
    }
}
