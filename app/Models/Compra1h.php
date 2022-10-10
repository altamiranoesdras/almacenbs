<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Compra1h
 * @package App\Models
 * @version July 27, 2022, 12:27 pm CST
 *
 * @property \App\Models\Compra $compra
 * @property \App\Models\User $usuarioProcesa
 * @property \App\Models\EnviosFiscale $envioFiscal
 * @property \Illuminate\Database\Eloquent\Collection $compra1hDetalles
 * @property integer $compra_id
 * @property integer $envio_fiscal_id
 * @property string $codigo
 * @property integer $correlativo
 * @property integer $del
 * @property integer $al
 * @property string|\Carbon\Carbon $fecha_procesa
 * @property integer $usuario_procesa
 * @property string $observaciones
 */
class Compra1h extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'compra_1h';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'compra_id',
        'envio_fiscal_id',
        'codigo',
        'correlativo',
        'del',
        'al',
        'fecha_procesa',
        'usuario_procesa',
        'observaciones'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'compra_id' => 'integer',
        'envio_fiscal_id' => 'integer',
        'codigo' => 'string',
        'correlativo' => 'integer',
        'del' => 'integer',
        'al' => 'integer',
        'fecha_procesa' => 'datetime',
        'usuario_procesa' => 'integer',
        'observaciones' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'compra_id' => 'required',
        'envio_fiscal_id' => 'required',
        'codigo' => 'nullable|string|max:45',
        'correlativo' => 'nullable|integer',
        'del' => 'nullable|integer',
        'al' => 'nullable|integer',
        'fecha_procesa' => 'nullable',
        'usuario_procesa' => 'required',
        'observaciones' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function compra()
    {
        return $this->belongsTo(\App\Models\Compra::class, 'compra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioProcesa()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_procesa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function envioFiscal()
    {
        return $this->belongsTo(\App\Models\EnviosFiscale::class, 'envio_fiscal_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function detalles()
    {
        return $this->hasMany(\App\Models\Compra1hDetalle::class, '1h_id');
    }
}
