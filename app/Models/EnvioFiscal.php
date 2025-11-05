<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $nombre_tabla
 * @property string|null $numero_resolucion
 * @property string|null $numero_gestion
 * @property \Illuminate\Support\Carbon|null $fecha_gestion
 * @property string|null $correlativo_resolucion
 * @property \Illuminate\Support\Carbon|null $fecha_correlativo_resolucion
 * @property string|null $serie_envio
 * @property string|null $numero_envio
 * @property \Illuminate\Support\Carbon|null $fecha_envio
 * @property int $correlativo_del
 * @property int $correlativo_al
 * @property int $correlativo_inicial
 * @property int $correlativo_actual
 * @property string|null $libro
 * @property int|null $folio
 * @property string|null $activo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra1h> $compra1hs
 * @property-read int|null $compra1hs_count
 * @property-read mixed $nombre
 * @method static \Database\Factories\EnvioFiscalFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal query()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCorrelativoActual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCorrelativoAl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCorrelativoDel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCorrelativoInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCorrelativoResolucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereFechaCorrelativoResolucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereFechaEnvio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereFechaGestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereFolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereLibro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereNombreTabla($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereNumeroEnvio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereNumeroGestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereNumeroResolucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereSerieEnvio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal withoutTrashed()
 * @mixin \Eloquent
 */
class EnvioFiscal extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'envios_fiscales';

    const TABLA_COMPRAS = 'compras';
    const TABLA_SOLICITUDES = 'solicitudes';


    public $fillable = [
        'nombre_tabla',
        'numero_resolucion',
        'numero_gestion',
        'fecha_gestion',
        'correlativo_resolucion',
        'fecha_correlativo_resolucion',
        'serie_envio',
        'numero_envio',
        'fecha_envio',
        'correlativo_del',
        'correlativo_al',
        'correlativo_inicial',
        'correlativo_actual',
        'libro',
        'folio',
        'activo'
    ];

    protected $casts = [
        'nombre_tabla' => 'string',
        'numero_resolucion' => 'string',
        'numero_gestion' => 'string',
        'fecha_gestion' => 'date',
        'correlativo_resolucion' => 'string',
        'fecha_correlativo_resolucion' => 'date',
        'serie_envio' => 'string',
        'numero_envio' => 'string',
        'fecha_envio' => 'date',
        'libro' => 'string',
        'activo' => 'string'
    ];

    public static $rules = [
        'nombre_tabla' => 'required|string|max:255',
        'numero_resolucion' => 'nullable|string|max:255',
        'numero_gestion' => 'nullable|string|max:255',
        'fecha_gestion' => 'nullable',
        'correlativo_resolucion' => 'nullable|string|max:255',
        'fecha_correlativo_resolucion' => 'nullable',
        'serie_envio' => 'nullable|string|max:255',
        'numero_envio' => 'nullable|string|max:255',
        'fecha_envio' => 'nullable',
        'correlativo_del' => 'required',
        'correlativo_al' => 'required',
        'correlativo_inicial' => 'required',
        'correlativo_actual' => 'required',
        'libro' => 'nullable|string|max:255',
        'folio' => 'nullable',
        'activo' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    const COMPRA = 1;
    const SOLICITUD = 2;

    public static $messages = [

    ];

    public function compra1hs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Compra1h::class, 'envio_fiscal_id');
    }

    public function solicitudes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Solicitude::class, 'envio_fiscal_id');
    }

    public function desactivar()
    {
        $this->activo = 'no';
        $this->save();
    }

    public function siguienteFolio()
    {
        // si se llega al final del rango desactiva el envio fiscal
        if($this->correlativo_actual >= $this->correlativo_al) {
            $this->desactivar();
        }else{
            $this->increment('correlativo_actual');
        }

        $this->save();

    }

    public function getNombreAttribute()
    {
        switch ($this->nombre_tabla) {
            case 'compras':
                return 'Formularios de 1H';
                break;
            case 'solicitudes':
                return 'Requisiciones almacén';
                break;
            default:
                return $this->nombre_tabla;
                break;
        }

    }
}
