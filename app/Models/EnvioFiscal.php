<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property string $nombre_tabla
 * @property int $correlativo_del
 * @property int $correlativo_al
 * @property int $folio_inicial
 * @property int $folio_actual
 * @property int|null $numero_constancia
 * @property string|null $serie_constancia
 * @property \Illuminate\Support\Carbon|null $fecha
 * @property string|null $numero_cuenta
 * @property string|null $forma
 * @property string|null $serie
 * @property string|null $numero
 * @property string|null $libro
 * @property int|null $folio
 * @property string|null $resolucion
 * @property string|null $numero_gestion
 * @property \Illuminate\Support\Carbon|null $fecha_gestion
 * @property string|null $correlativo
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
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCorrelativoAl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCorrelativoDel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereFechaGestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereFolio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereFolioActual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereFolioInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereForma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereLibro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereNombreTabla($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereNumeroConstancia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereNumeroCuenta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereNumeroGestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereResolucion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnvioFiscal whereSerieConstancia($value)
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

    public $fillable = [
        'nombre_tabla',
        'correlativo_del',
        'correlativo_al',
        'folio_inicial',
        'folio_actual',
        'numero_constancia',
        'serie_constancia',
        'fecha',
        'numero_cuenta',
        'forma',
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

    protected $casts = [
        'nombre_tabla' => 'string',
        'serie_constancia' => 'string',
        'fecha' => 'date:Y-m-d',
        'numero_cuenta' => 'string',
        'forma' => 'string',
        'serie' => 'string',
        'numero' => 'string',
        'libro' => 'string',
        'resolucion' => 'string',
        'numero_gestion' => 'string',
        'fecha_gestion' => 'date:Y-m-d',
        'correlativo' => 'string',
        'activo' => 'string'
    ];

    public static $rules = [
        'nombre_tabla' => 'required|string|max:255',
        'correlativo_del' => 'required',
        'correlativo_al' => 'required',
        'folio_inicial' => 'required',
        'folio_actual' => 'required',
        'numero_constancia' => 'nullable',
        'serie_constancia' => 'nullable|string|max:255',
        'fecha' => 'nullable',
        'numero_cuenta' => 'nullable|string|max:255',
        'forma' => 'nullable|string|max:255',
        'serie' => 'nullable|string|max:255',
        'numero' => 'nullable|string|max:255',
        'libro' => 'nullable|string|max:255',
        'folio' => 'nullable',
        'resolucion' => 'nullable|string|max:255',
        'numero_gestion' => 'nullable|string|max:255',
        'fecha_gestion' => 'nullable',
        'correlativo' => 'nullable|string|max:255',
        'activo' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function compra1hs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Compra1h::class, 'envio_fiscal_id');
    }

    public function desactivar()
    {
        $this->activo = 'no';
        $this->save();
    }

    public function siguienteFolio()
    {
        // si se llega al final del rango desactiva el envio fiscal
        if($this->folio_actual >= $this->correlativo_al) {
            $this->desactivar();
        }else{
            $this->increment('folio_actual');
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
