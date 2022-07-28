<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EnvioFiscal
 * @package App\Models
 * @version July 27, 2022, 12:26 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $compra1hs
 * @property integer $nuemero_constancia
 * @property string $serie_constancia
 * @property string $fecha
 * @property string $numero_cuenta
 * @property string $forma
 * @property integer $correlativo_del
 * @property integer $correlativo_al
 * @property integer $cantidad
 * @property integer $pendientes
 * @property string $serie
 * @property string $numero
 * @property string $libro
 * @property integer $folio
 * @property string $resolucion
 * @property string $numero_gestion
 * @property string $fecha_gestion
 * @property string $correlativo
 * @property string $activo
 */
class EnvioFiscal extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'envios_fiscales';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nuemero_constancia',
        'serie_constancia',
        'fecha',
        'numero_cuenta',
        'forma',
        'correlativo_del',
        'correlativo_al',
        'cantidad',
        'pendientes',
        'serie',
        'numero',
        'libro',
        'folio',
        'resolucion',
        'numero_gestion',
        'fecha_gestion',
        'correlativo',
        'activo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nuemero_constancia' => 'integer',
        'serie_constancia' => 'string',
        'fecha' => 'date',
        'numero_cuenta' => 'string',
        'forma' => 'string',
        'correlativo_del' => 'integer',
        'correlativo_al' => 'integer',
        'cantidad' => 'integer',
        'pendientes' => 'integer',
        'serie' => 'string',
        'numero' => 'string',
        'libro' => 'string',
        'folio' => 'integer',
        'resolucion' => 'string',
        'numero_gestion' => 'string',
        'fecha_gestion' => 'date',
        'correlativo' => 'string',
        'activo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nuemero_constancia' => 'required|integer',
        'serie_constancia' => 'required|string|max:10',
        'fecha' => 'required',
        'numero_cuenta' => 'required|string|max:45',
        'forma' => 'required|string|max:45',
        'correlativo_del' => 'required|integer',
        'correlativo_al' => 'required|integer',
        'cantidad' => 'required|integer',
        'pendientes' => 'required|integer',
        'serie' => 'required|string|max:45',
        'numero' => 'required|string|max:45',
        'libro' => 'required|string|max:45',
        'folio' => 'required|integer',
        'resolucion' => 'required|string|max:45',
        'numero_gestion' => 'required|string|max:45',
        'fecha_gestion' => 'required',
        'correlativo' => 'required|string|max:45',
        'activo' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function compra1hs()
    {
        return $this->hasMany(\App\Models\Compra1h::class, 'envio_fiscal_id');
    }
}
