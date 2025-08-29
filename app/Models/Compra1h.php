<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use stdClass;

/**
 * Class Compra1h
 *
 * @property int $id
 * @property string|null $folio
 * @property int $compra_id
 * @property int $envio_fiscal_id
 * @property string|null $codigo
 * @property int|null $correlativo
 * @property int|null $del
 * @property int|null $al
 * @property \Illuminate\Support\Carbon|null $fecha_procesa
 * @property int $usuario_procesa
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Compra $compra
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra1hDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\EnvioFiscal $envioFiscal
 * @property-read mixed $sub_total
 * @property-read mixed $total
 * @property-read mixed $total_letras
 * @property-read \App\Models\User $usuarioProcesa
 * @method static \Database\Factories\Compra1hFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h query()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereAl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereCompraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereDel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereEnvioFiscalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereFechaProcesa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereFolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h whereUsuarioProcesa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra1h withoutTrashed()
 * @mixin \Eloquent
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
        'folio',
        'compra_id',
        'envio_fiscal_id',
        'codigo',
        'correlativo',
        'del',
        'al',
        'fecha_procesa',
        'usuario_procesa',
        'observaciones',
        'justificativa_anulacion'
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
        'observaciones' => 'string',
        'justificativa_anulacion' => 'string'
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
        'justificativa_anulacion' => 'nullable|string',
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
        return $this->belongsTo(\App\Models\EnvioFiscal::class, 'envio_fiscal_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function detalles()
    {
        return $this->hasMany(\App\Models\Compra1hDetalle::class, '1h_id');
    }

    public function getSubTotalAttribute()
    {

        $monto = $this->detalles->sum(function (Compra1hDetalle $det){
            return $det->cantidad*$det->precio;
        });

        $decimales = $monto - floor($monto);
        $decimalesRedondeados = round($decimales, config('app.cantidad_decimales_precio', 2));

        if ($decimalesRedondeados == 0.99) {
            return (float) ceil($monto);
        }

        return $monto;
    }

    public function getTotalAttribute()
    {
        return $this->sub_total - ($this->descuento ?? 0);
    }

    public function getTotalLetrasAttribute()
    {
        $currency = new stdClass();

        $currency->plural = 'QUETZALES';
        $currency->singular = 'QUETZAL';
        $currency->centPlural = 'CENTAVOS';
        $currency->centSingular = 'CENTAVO';

        $totalTexto = numALetrasConmoneda($this->total, $currency);

        return $totalTexto;
    }
}
