<?php

namespace App\Models;

use App\Traits\HasBitacora;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

/**
 * Class Solicitud
 *
 * @property int $id
 * @property string|null $codigo
 * @property int|null $correlativo
 * @property string|null $justificacion
 * @property string|null $observaciones
 * @property int|null $unidad_id
 * @property int|null $bodega_id
 * @property int $usuario_crea
 * @property int|null $usuario_solicita
 * @property int|null $usuario_autoriza
 * @property int|null $usuario_aprueba
 * @property int|null $usuario_despacha
 * @property string|null $firma_requiere
 * @property string|null $firma_autoriza
 * @property string|null $firma_aprueba
 * @property string|null $firma_almacen
 * @property \Illuminate\Support\Carbon|null $fecha_solicita
 * @property \Illuminate\Support\Carbon|null $fecha_autoriza
 * @property \Illuminate\Support\Carbon|null $fecha_aprueba
 * @property \Illuminate\Support\Carbon|null $fecha_almacen_firma
 * @property \Illuminate\Support\Carbon|null $fecha_informa
 * @property \Illuminate\Support\Carbon|null $fecha_despacha
 * @property int $estado_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $envio_fiscal_id
 * @property-read Collection<int, \App\Models\Bitacora> $bitacoras
 * @property-read int|null $bitacoras_count
 * @property-read \App\Models\Bodega|null $bodega
 * @property-read Collection<int, \App\Models\SolicitudDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\EnvioFiscal|null $envioFiscal
 * @property-read \App\Models\SolicitudEstado $estado
 * @property-read mixed $motivo_retorna
 * @property-read float $total_detalles
 * @property-read string $total_letras
 * @property-read \App\Models\RrhhUnidad|null $unidad
 * @property-read \App\Models\User|null $usuarioAprueba
 * @property-read \App\Models\User|null $usuarioAutoriza
 * @property-read \App\Models\User $usuarioCrea
 * @property-read \App\Models\User|null $usuarioDespacha
 * @property-read \App\Models\User|null $usuarioSolicita
 * @method static Builder|Solicitud aprobadas()
 * @method static Builder|Solicitud autorizadas()
 * @method static Builder|Solicitud deUnidad($unidad = null)
 * @method static Builder|Solicitud delUsuarioCrea($user = null)
 * @method static \Database\Factories\SolicitudFactory factory($count = null, $state = [])
 * @method static Builder|Solicitud newModelQuery()
 * @method static Builder|Solicitud newQuery()
 * @method static Builder|Solicitud onlyTrashed()
 * @method static Builder|Solicitud query()
 * @method static Builder|Solicitud solicitadas()
 * @method static Builder|Solicitud temporal()
 * @method static Builder|Solicitud whereBodegaId($value)
 * @method static Builder|Solicitud whereCodigo($value)
 * @method static Builder|Solicitud whereCorrelativo($value)
 * @method static Builder|Solicitud whereCreatedAt($value)
 * @method static Builder|Solicitud whereDeletedAt($value)
 * @method static Builder|Solicitud whereEnvioFiscalId($value)
 * @method static Builder|Solicitud whereEstadoId($value)
 * @method static Builder|Solicitud whereFechaAlmacenFirma($value)
 * @method static Builder|Solicitud whereFechaAprueba($value)
 * @method static Builder|Solicitud whereFechaAutoriza($value)
 * @method static Builder|Solicitud whereFechaDespacha($value)
 * @method static Builder|Solicitud whereFechaInforma($value)
 * @method static Builder|Solicitud whereFechaSolicita($value)
 * @method static Builder|Solicitud whereFirmaAlmacen($value)
 * @method static Builder|Solicitud whereFirmaAprueba($value)
 * @method static Builder|Solicitud whereFirmaAutoriza($value)
 * @method static Builder|Solicitud whereFirmaRequiere($value)
 * @method static Builder|Solicitud whereId($value)
 * @method static Builder|Solicitud whereJustificacion($value)
 * @method static Builder|Solicitud whereObservaciones($value)
 * @method static Builder|Solicitud whereUnidadId($value)
 * @method static Builder|Solicitud whereUpdatedAt($value)
 * @method static Builder|Solicitud whereUsuarioAprueba($value)
 * @method static Builder|Solicitud whereUsuarioAutoriza($value)
 * @method static Builder|Solicitud whereUsuarioCrea($value)
 * @method static Builder|Solicitud whereUsuarioDespacha($value)
 * @method static Builder|Solicitud whereUsuarioSolicita($value)
 * @method static Builder|Solicitud withTrashed()
 * @method static Builder|Solicitud withoutTrashed()
 * @mixin \Eloquent
 */
class Solicitud extends Model
{
    use SoftDeletes;

    use HasFactory;
    use HasBitacora;

    public $table = 'solicitudes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['motivo_retorna'];

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
        'bodega_id',

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
        'estado_id',

        'envio_fiscal_id',
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
        'justificacion' => 'required|string|max:350',
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
        return $this->belongsTo(User::class, 'usuario_despacha');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioSolicita()
    {
        return $this->belongsTo(User::class, 'usuario_solicita');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(SolicitudEstado::class, 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioCrea()
    {
        return $this->belongsTo(User::class, 'usuario_crea');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioAutoriza()
    {
        return $this->belongsTo(User::class, 'usuario_autoriza');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioAprueba()
    {
        return $this->belongsTo(User::class, 'usuario_aprueba');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unidad()
    {
        return $this->belongsTo(RrhhUnidad::class, 'unidad_id');
    }

    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'bodega_id');
    }

    public function envioFiscal(): BelongsTo
    {
        return $this->belongsTo(EnvioFiscal::class, 'envio_fiscal_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function detalles()
    {
        return $this->hasMany(SolicitudDetalle::class, 'solicitud_id');
    }

    public function scopeTemporal(Builder $q)
    {
        $q->withoutGlobalScope('noTemporal')->where('estado_id',SolicitudEstado::TEMPORAL);
    }

    public function scopeDelUsuarioCrea($q,$user=null)
    {
        $user = $user ?? usuarioAutenticado();

        $q->where('usuario_crea',$user->id);
    }

    public function muestraCantidadAprobar()
    {

        return $this->fecha_aprueba && $this->fecha_aprueba->isPast();

//        return in_array($this->estado_id,[
//            SolicitudEstado::SOLICITADA,
//            SolicitudEstado::AUTORIZADA,
//            SolicitudEstado::APROBADA,
//            SolicitudEstado::ANULADA,
//            SolicitudEstado::DESPACHADA,
//        ]);
    }

    public function muestraCantidadDespachar()
    {

        return $this->fecha_despacha && $this->fecha_despacha->isPast();

//        return in_array($this->estado_id,[
//            SolicitudEstado::AUTORIZADA,
//            SolicitudEstado::APROBADA,
//            SolicitudEstado::DESPACHADA,
//            SolicitudEstado::ANULADA,
//        ]);
    }

    public function esTemporal()
    {
        return $this->estado_id==SolicitudEstado::TEMPORAL;
    }

    public function estaAutoizada()
    {
        return $this->estado_id==SolicitudEstado::AUTORIZADA;
    }


    public function estaAprobada()
    {
        return $this->estado_id==SolicitudEstado::APROBADA;
    }


    public function estaDespachada()
    {
        return $this->estado_id==SolicitudEstado::DESPACHADA;
    }

    public function estaAnulada()
    {
        return $this->estado_id==SolicitudEstado::ANULADA;
    }


    public function puedeEditar()
    {
        return in_array($this->estado_id,[
                SolicitudEstado::TEMPORAL,
                SolicitudEstado::INGRESADA,
                SolicitudEstado::RETORNO_SOLICITADA,
            ]);
    }

    public function puedeSolicitar()
    {
        return in_array($this->estado_id,[
            SolicitudEstado::INGRESADA,
            SolicitudEstado::RETORNO_SOLICITADA,
        ]);
    }

    public function puedeAutorizar()
    {
        return $this->estado_id == SolicitudEstado::SOLICITADA;
    }

    public function puedeAprobar()
    {
        return in_array($this->estado_id,[
            SolicitudEstado::SOLICITADA,
            SolicitudEstado::AUTORIZADA
        ]);
    }

    public function puedeDespachar()
    {
        return $this->estado_id == SolicitudEstado::APROBADA;
    }

    public function puedeImprimir()
    {
        return in_array($this->estado_id,[
            SolicitudEstado::SOLICITADA,
            SolicitudEstado::APROBADA,
            SolicitudEstado::AUTORIZADA,
            SolicitudEstado::DESPACHADA,
            SolicitudEstado::ANULADA,
//            SolicitudEstado::CANCELADA,
        ]);
    }

    public function puedeAnular()
    {
        return $this->estado_id != SolicitudEstado::ANULADA;
//        return $this->estado_id != SolicitudEstado::ANULADA && $this->estado_id == SolicitudEstado::DESPACHADA;
    }

    public function tieneStock()
    {
        $sinStock = collect();

        /**
         * @var SolicitudDetalle $det
         */
        foreach ($this->detalles as $index => $det) {
            if ($det->cantidad_solicitada > $det->item->stock_total){
                $sinStock->push($det);
            }
        }

        return $sinStock->count() == 0;
    }


    public function egreso()
    {

        /**
         * @var SolicitudDetalle $detalle
         */
        foreach ($this->detalles as $detalle){
            $detalle->egreso();
        }

        $this->estado_id = SolicitudEstado::DESPACHADA;
        $this->fecha_despacha = Carbon::now();
        $this->save();

    }

    public function ingreso()
    {

        $bodega = $this->bodega_id ?? null;

        if ($bodega && $bodega != Bodega::PRINCIPAL) {
            /**
             * @var SolicitudDetalle $detalle
             */
            foreach ($this->detalles as $detalle) {

                $detalle->ingreso($bodega);
            }
        }

    }

    public function anular()
    {


        if ($this->estaDespachada()){

            /**
             * @var SolicitudDetalle $detalle
             */
            foreach ($this->detalles as $detalle){
                $detalle->anular();
            }
        }

        $this->estado_id = SolicitudEstado::ANULADA;
        $this->save();

        $this->addBitacora("REQUISICIÓN ANULADA","");


    }

    public function scopeDeUnidad(Builder $q,$unidad = null)
    {
        $unidad = $unidad ?? auth()->user()->unidad_id;
        $q->where('unidad_id',SolicitudEstado::SOLICITADA);
    }

    public function scopeSolicitadas(Builder $q)
    {
        $q->where('estado_id',SolicitudEstado::SOLICITADA);
    }


    public function scopeAutorizadas(Builder $q)
    {
        $q->where('estado_id',SolicitudEstado::AUTORIZADA);
    }

    public function scopeAprobadas(Builder $q)
    {
        $q->where('estado_id',SolicitudEstado::APROBADA);
    }

    public function ultimaBitacora()
    {
        return $this->bitacoras->last() ?? null;
    }

    public function getMotivoRetornaAttribute()
    {
        $retornada = in_array($this->estado_id,[
            SolicitudEstado::RETORNO_SOLICITADA,
            SolicitudEstado::RETORNO_APROBADA,
            SolicitudEstado::RETORNO_AUTORIZADA,
        ]);

        if ($retornada){
            return $this->ultimaBitacora()->comentario ?? null;
        }

        return null;
    }

    public function aprobar($fecha=null): void
    {
        $this->estado_id = SolicitudEstado::APROBADA;
        $this->fecha_aprueba = $fecha ?? Carbon::now();
        $this->usuario_aprueba = usuarioAutenticado()->id;
        $this->save();

        $this->addBitacora("REQUISICIÓN APROBADA","");

    }

    public function autorizar($fecha=null): void
    {
        $this->estado_id = SolicitudEstado::AUTORIZADA;
        $this->fecha_autoriza =  $fecha ?? Carbon::now();
        $this->usuario_autoriza = usuarioAutenticado()->id;
        $this->save();

        $this->addBitacora("REQUISICIÓN AUTORIZADA","");
    }

    public function solicitar($fecha=null): void
    {
        $this->estado_id = SolicitudEstado::SOLICITADA;
        $this->fecha_solicita =  $fecha ?? Carbon::now();
        $this->usuario_solicita = usuarioAutenticado()->id;
        $this->save();

        $this->addBitacora("REQUISICIÓN SOLICITADA","");
    }

    public function despachar($fecha=null): void
    {

        //actualiza las cantidades despachadas, si son enviadas desde el formulario
        foreach ($this->detalles as $index => $detalle) {
            $detalle->cantidad_despachada = request()->cantidades_despacha[$index] ?? $detalle->cantidad_autorizada;
            $detalle->save();
        }

        $this->estado_id = SolicitudEstado::DESPACHADA;
        $this->fecha_despacha =  $fecha ?? Carbon::now();
        $this->usuario_despacha = usuarioAutenticado()->id;
        $this->save();

        $this->egreso();
        $this->ingreso();

        $this->addBitacora("REQUISICIÓN DESPACHADA","");
    }

    public function getTotalDetallesAttribute(): float
    {
        return $this->detalles->sum('sub_total');
    }

    public function getTotalLetrasAttribute(): string
    {
        $currency = new stdClass();

        $currency->plural = 'QUETZALES';
        $currency->singular = 'QUETZAL';
        $currency->centPlural = 'CENTAVOS';
        $currency->centSingular = 'CENTAVO';

        return numALetrasConmoneda($this->total_detalles, $currency);
    }

}
