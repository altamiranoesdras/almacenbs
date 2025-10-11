<?php

namespace App\Models;

use App\Traits\HasBitacora;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Compra
 *
 * @property int $id
 * @property int|null $tipo_id
 * @property int|null $proveedor_id
 * @property string|null $codigo
 * @property int|null $correlativo
 * @property int|null $unidad_solicita_id
 * @property \Illuminate\Support\Carbon|null $fecha_documento Fecha del documento de  la Factura
 * @property \Illuminate\Support\Carbon|null $fecha_ingreso Fecha de ingreso al sistema
 * @property string|null $serie
 * @property string|null $numero
 * @property string|null $recibo_de_caja
 * @property int $estado_id
 * @property int $usuario_crea
 * @property int|null $usuario_recibe
 * @property string|null $orden_compra
 * @property string $descuento
 * @property string|null $folio_almacen
 * @property string|null $folio_inventario
 * @property string|null $observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bitacora> $bitacoras
 * @property-read int|null $bitacoras_count
 * @property-read \App\Models\Compra1h|null $compra1h
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Compra1h> $compra1hs
 * @property-read int|null $compra1hs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompraDetalle> $detalles
 * @property-read int|null $detalles_count
 * @property-read \App\Models\CompraEstado $estado
 * @property-read mixed $anio
 * @property-read mixed $color_estado
 * @property-read mixed $mes
 * @property-read mixed $sub_total
 * @property-read mixed $total
 * @property-read mixed $total_venta
 * @property-read \App\Models\Proveedor|null $proveedor
 * @property-read \App\Models\CompraTipo|null $tipo
 * @property-read \App\Models\RrhhUnidad|null $unidadSolicitante
 * @property-read \App\Models\User $usuarioCrea
 * @property-read \App\Models\User|null $usuarioRecibe
 * @method static \Illuminate\Database\Eloquent\Builder|Compra delItem($item)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra delUser($user = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra delUsuarioCrea($user = null)
 * @method static \Database\Factories\CompraFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Compra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra noAnuladas()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra noTemporal()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra query()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra temporal()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereDescuento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFechaDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFolioAlmacen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFolioInventario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereOrdenCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereProveedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereReciboDeCaja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUnidadSolicitaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUsuarioCrea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUsuarioRecibe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra withoutTrashed()
 * @mixin \Eloquent
 */
class Compra extends Model
{
    use SoftDeletes;

    use HasFactory;
    use HasBitacora;

    public $table = 'compras';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];



    public $fillable = [
        'tipo_id',
        'proveedor_id',
        'codigo',
        'correlativo',
        'fecha_documento',
        'fecha_ingreso',
        'serie',
        'numero',
        'recibo_de_caja',
        'estado_id',
        'usuario_crea',
        'usuario_recibe',
        'observaciones',
        'orden_compra',
        'descuento',
        'folio_almacen',
        'folio_inventario',
        'unidad_solicita_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo_id' => 'integer',
        'proveedor_id' => 'integer',
        'codigo' => 'string',
        'correlativo' => 'integer',
        'fecha_documento' => 'date',
        'fecha_ingreso' => 'date',
        'serie' => 'string',
        'numero' => 'string',
        'recibo_de_caja' => 'string',
        'estado_id' => 'integer',
        'usuario_crea' => 'integer',
        'usuario_recibe' => 'integer',
        'observaciones' => 'string',
        'orden_compra' => 'string',
        'unidad_solicita_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo_id' => 'required',
        'proveedor_id' => 'required',
        'codigo' => 'nullable|string|max:45',
        'correlativo' => 'nullable|integer',
        'fecha_documento' => 'nullable',
        'fecha_ingreso' => 'nullable',
        'serie' => 'nullable|string|max:45',
        'numero' => 'nullable|string|max:20',
        'recibo_de_caja' => 'nullable|string|max:255',
        'estado_id' => 'nullable',
        'usuario_crea' => 'nullable',
        'usuario_recibe' => 'nullable',
        'observaciones' => 'nullable|string',
        'orden_compra' => 'required|integer',
        'unidad_solicita_id' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    protected $appends = ['total_venta'];

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
    public function unidadSolicitante()
    {
        return $this->belongsTo(\App\Models\RrhhUnidad::class, 'unidad_solicita_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function proveedor()
    {
        return $this->belongsTo(\App\Models\Proveedor::class, 'proveedor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipo()
    {
        return $this->belongsTo(\App\Models\CompraTipo::class, 'tipo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuarioRecibe()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_recibe');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(\App\Models\CompraEstado::class, 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function compra1hs()
    {
        return $this->hasMany(\App\Models\Compra1h::class, 'compra_id');
    }

    public function compra1h()
    {
        return $this->hasOne(\App\Models\Compra1h::class, 'compra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function detalles()
    {
        return $this->hasMany(CompraDetalle::class,'compra_id','id');
    }


    public function getTotalAttribute()
    {
        return $this->sub_total - ($this->descuento ?? 0);
    }


    public function actualizaPreciosItem()
    {
        /**
         * @var CompraDetalle $detalle
         */
        foreach ($this->detalles as $index => $detalle) {

            /**
             * @var Item $item
             */
            $item = $detalle->item;

            if($detalle->precio > 0){

                $item->precio_compra = $detalle->precio;
                $item->precio_promedio = $item->precioPromedio();
                $item->save();
            }
        }
    }



    public function scopeDelUser($query,$user=null)
    {
        $user = $user ?? auth()->user()->id ?? null;

        if ($user){

            return $query->where('usuario_crea',$user);
        }

        return $query;
    }


    public function getSubTotalAttribute()
    {
        $monto = $this->detalles->sum(function ($det){
            return $det->cantidad*$det->precio;
        });

        $decimales = $monto - floor($monto);
        $decimalesRedondeados = round($decimales, config('app.cantidad_decimales_precio', 2));

        if ($decimalesRedondeados == 0.99) {
            return (float) ceil($monto);
        }

        return $monto;
    }

    public function getTotalVentaAttribute()
    {

        return $this->detalles->sum(function ($det){
            return $det->cantidad*$det->item->precio_compra;
//            return $det->cantidad*$det->item->precio_venta;
        });

    }


    public function procesaIngreso()
    {

        /**
         * @var CompraDetalle $detalle
         */
        foreach ($this->detalles as $detalle){
            $detalle->ingreso();
        }

        $this->estado_id = CompraEstado::INGRESADO;
//        $this->fecha_ingreso = hoyDb();
        $this->save();

        $this->actualizaPreciosItem();

        $this->addBitacora("Ingreso de almacén ingresado");

        $this->procesarKardex();

    }

    public function procesarKardex()
    {

        /**
         * @var CompraDetalle $detalle
         */
        foreach ($this->agruparDetalles() as $index => $detalle) {
            $detalle->agregarKardex();
        }

    }

    public function scopeDelItem($query,$item)
    {
        return $query->whereIn('id', function($q) use ($item){
            $q->select('compra_id')->from('compra_detalles')->where('item_id',$item);
        });
    }

    public function scopeTemporal($q)
    {
        $q->where('estado_id',CompraEstado::TEMPORAL);
    }

    public function scopeDelUsuarioCrea($q,$user=null)
    {
        $user = $user ?? auth()->user() ?? auth('api')->user();


        $q->where('usuario_crea',$user->id);
    }

    public function scopeNoTemporal($q)
    {
        $q->where('estado_id','!=',CompraEstado::TEMPORAL);
    }

    public function scopeNoAnuladas($q)
    {
        $q->where('estado_id','!=',CompraEstado::ANULADO);
    }


    public function anular()
    {
        $this->estado_id = CompraEstado::ANULADO;
        $this->save();


        /**
         * @var CompraDetalle $detalle
         */
        foreach ($this->detalles as $detalle){
            $detalle->anular();
        }

        $this->addBitacora("Compra anulada");
    }


    public function tiene1h()
    {
        return $this->compra1hs->count() > 0;
    }

    public function estaRecibida()
    {
        return $this->estado_id==CompraEstado::INGRESADO;
    }

    public function estaAutorizado1h()
    {
        return in_array($this->estado_id,[
            CompraEstado::UNO_H_AUTORIZADO,
        ]);
    }

    //esat aprobado 1h
    public function estaAprobado1h()
    {
        return in_array($this->estado_id,[
            CompraEstado::UNO_H_APROBADO,
        ]);
    }

    public function estaOperado1h()
    {
        return in_array($this->estado_id,[
            CompraEstado::UNO_H_OPERADO,
        ]);
    }

    //estaPendiente de recibir
    public function estaPendienteRecibir(): bool
    {
        return in_array($this->estado_id,[
            CompraEstado::PROCESADO_PENDIENTE_RECIBIR,
        ]);
    }

    public function puedeAnular()
    {
        return $this->estado_id != CompraEstado::ANULADO && in_array($this->estado_id,[
                CompraEstado::INGRESADO,
                CompraEstado::UNO_H_OPERADO,
                CompraEstado::UNO_H_APROBADO,
                CompraEstado::UNO_H_AUTORIZADO,
                CompraEstado::RETORNO_POR_APROBADOR,
                CompraEstado::RETORNO_POR_AUTORIZADOR,
        ]);
    }

    public function puedeCancelar()
    {
        return $this->estado_id == CompraEstado::PROCESADO_PENDIENTE_RECIBIR;
    }

    public function getAnioAttribute()
    {
        return $this->fecha_ingreso ? $this->fecha_ingreso->format('Y') : null;
    }


    public function getMesAttribute()
    {
        return $this->fecha_ingreso ? $this->fecha_ingreso->format('m') : null;
    }

    public function puedeEditar()
    {
        return in_array($this->estado_id,[
            CompraEstado::PROCESADO_PENDIENTE_RECIBIR,
            CompraEstado::INGRESADO
        ]);
    }

    public function tieneDobleIngreso()
    {

        $detallesConDobleTransaccion = $this->detalles->filter(function ($detalle) {
            return $detalle->transaccionesStock->count() > 1;
        });

        return $detallesConDobleTransaccion->count() > 0;

    }

    public function genera1h($folio=null): void
    {

        $envioFiscal = EnvioFiscal::where('nombre_tabla', 'compras')->where('activo', 'si')->first();

        $folio = $folio ?? $envioFiscal->correlativo_actual;

        /**
         * @var Compra1h $compra1h
         */
        $compra1h = Compra1h::create([
            'folio' => $folio,
            'compra_id' => $this->id,
            'envio_fiscal_id' => $envioFiscal->id,
            'codigo' => $this->getCodigo1h(),
            'correlativo' => $this->getCorrelativo1h(),
            'del' => 0,
            'al' => 0,
            'fecha_procesa' => Carbon::now(),
            'usuario_procesa' => auth()->user()->id ?? User::PRINCIPAL,
            'observaciones' => null
        ]);

        if ($this->detalles->count() > 0) {

            foreach ($this->agruparDetalles() as $index => $detalle) {


                if ($detalle->item->esActivoFijo() && configuracion()->desglosarActivosFijos1h()) {

                    // crear un detalle por cada activo fijo
                    for ($i = 0; $i < $detalle->cantidad; $i++) {

                        $compra1hDetalle = Compra1hDetalle::create([
                            '1h_id' => $compra1h->id,
                            'item_id' => $detalle->item_id,
                            'precio' => $detalle->precio,
                            'cantidad' => 1,
                            'folio_almacen' => $detalle->folio_almacen,
                            'folio_inventario' => $detalle->folio_inventario,
                        ]);

                    }

                }
                else{

                    $compra1hDetalle = Compra1hDetalle::create([
                        '1h_id' => $compra1h->id,
                        'item_id' => $detalle->item_id,
                        'precio' => $detalle->precio,
                        'cantidad' => $detalle->cantidad,
                        'folio_almacen' => $detalle->folio_almacen ,
                        'folio_inventario' => $detalle->folio_inventario,
                    ]);

                }


            }

        }


        // actualizar folio en envio fiscal
        $envioFiscal->siguienteFolio();

        $this->addBitacora("Formulario 1H generado, folio: ".$compra1h->folio);

    }


    public function getCodigo1h($cantidadCeros = 1)
    {
        return prefijoCeros($this->getCorrelativo1h(),$cantidadCeros)."-".Carbon::now()->year;
    }

    public function getCorrelativo1h()
    {

        $correlativo = Compra1h::withTrashed()->whereRaw('year(created_at) ='.Carbon::now()->year)->max('correlativo');


        if ($correlativo)
            return $correlativo+1;

        return 1;
    }

    public function getColorEstadoAttribute()
    {
        switch ($this->estado_id){
            case CompraEstado::TEMPORAL:
                return 'secondary';
            case CompraEstado::PROCESADO_PENDIENTE_RECIBIR:
                return 'info';
            case CompraEstado::INGRESADO:
                return 'success';
            case CompraEstado::UNO_H_AUTORIZADO:
            case CompraEstado::UNO_H_APROBADO:
            case CompraEstado::UNO_H_OPERADO:
                return 'primary';
            case CompraEstado::RETORNO_POR_AUTORIZADOR:
            case CompraEstado::RETORNO_POR_APROBADOR:
                return 'warning';
            case CompraEstado::ANULADO:
            case CompraEstado::CANCELADO:
                return 'danger';
            default:
                return 'light';
        }

    }

    public function puedeOperar()
    {
        return in_array($this->estado_id,[
            CompraEstado::INGRESADO,
            CompraEstado::PROCESADO_PENDIENTE_RECIBIR,
            CompraEstado::RETORNO_POR_APROBADOR,
        ]);
    }

    public function puedeAprobar()
    {
        return in_array($this->estado_id,[
            CompraEstado::UNO_H_OPERADO,
            CompraEstado::RETORNO_POR_AUTORIZADOR,
        ]);

    }

    public function puedeAutorizar()
    {
        return in_array($this->estado_id,[
            CompraEstado::UNO_H_APROBADO,
        ]);
    }

    //puede gestionar 1h
    public function puedeGestionar1h()
    {
        return in_array($this->estado_id,[
            CompraEstado::INGRESADO,
            CompraEstado::UNO_H_OPERADO,
            CompraEstado::UNO_H_APROBADO,
            CompraEstado::UNO_H_AUTORIZADO,
            CompraEstado::RETORNO_POR_APROBADOR,
            CompraEstado::RETORNO_POR_AUTORIZADOR,
        ]);
    }

    public function operar1h($comentario='')
    {
        $this->addBitacora("Formulario 1H Operado, folio: ".$this->compra1h->folio,$comentario);
        $this->estado_id = CompraEstado::UNO_H_OPERADO;
        $this->save();
    }

    //aprobar 1h
    public function aprobar1h($comentario='')
    {
        $this->addBitacora("Formulario 1H Aprobado, folio: ".$this->compra1h->folio,$comentario);
        $this->estado_id = CompraEstado::UNO_H_APROBADO;
        $this->save();
    }

    //autorizar 1h
    public function autorizar1h($comentario='')
    {
        $this->addBitacora("Formulario 1H Autorizado, folio: ".$this->compra1h->folio,$comentario);
        $this->estado_id = CompraEstado::UNO_H_AUTORIZADO;
        $this->save();

        $this->procesaIngreso();

    }

    //retornar a operador
    public function retornarAOperador1h($comentario='')
    {
        $this->addBitacora("Formulario 1H retornado a Operador, folio: ".$this->compra1h->folio,$comentario);
        $this->estado_id = CompraEstado::RETORNO_POR_APROBADOR;
        $this->save();
    }

    //retornar a aprobador
    public function retornarAAprobador1h($comentario='')
    {
        $this->addBitacora("Formulario 1H retornado a Aprobador, folio: ".$this->compra1h->folio,$comentario);
        $this->estado_id = CompraEstado::RETORNO_POR_AUTORIZADOR;
        $this->save();
    }

    public function puedeImprimir1h()
    {
        return in_array($this->estado_id,[
            CompraEstado::UNO_H_OPERADO,
            CompraEstado::UNO_H_APROBADO,
            CompraEstado::UNO_H_AUTORIZADO,
            CompraEstado::RETORNO_POR_APROBADOR,
            CompraEstado::RETORNO_POR_AUTORIZADOR,
        ]);

    }

    public function estaAnulada()
    {
        return $this->estado_id==CompraEstado::ANULADO;
    }

    public function esTemporal()
    {
        return $this->estado_id == CompraEstado::TEMPORAL;

    }

    /**
     * Cre un colección de detalles agrupados por item_id.
     */
    public function agruparDetalles(): \Illuminate\Support\Collection
    {
        return $this->detalles
            ->groupBy('item_id')
            ->map(function ($detalles, $itemId) {
                $detalle = $detalles->first();
                $detalle->cantidad = $detalles->sum('cantidad');
                return $detalle;
            })
            ->values();
    }

    public function esFacturaCambiaria(): bool
    {
        return $this->tipo_id == CompraTipo::FACTURA_CAMBIARIA;
    }


}
