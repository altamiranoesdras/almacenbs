<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Compra
 *
 * @package App\Models
 * @version July 27, 2022, 12:21 pm CST
 * @property \App\Models\User $usuarioCrea
 * @property \App\Models\Proveedor $proveedor
 * @property \App\Models\CompraTipo $tipo
 * @property \App\Models\User $usuarioRecibe
 * @property \App\Models\CompraEstado $estado
 * @property \Illuminate\Database\Eloquent\Collection $compra1hs
 * @property \Illuminate\Database\Eloquent\Collection $detalles
 * @property integer $tipo_id
 * @property integer $proveedor_id
 * @property string $codigo
 * @property integer $correlativo
 * @property Carbon $fecha_documento
 * @property Carbon $fecha_ingreso
 * @property string $serie
 * @property string $numero
 * @property integer $estado_id
 * @property integer $usuario_crea
 * @property integer $usuario_recibe
 * @property string $observaciones
 * @property string $orden_compra
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Compra1h|null $compra1h
 * @property-read int|null $compra1hs_count
 * @property-read int|null $detalles_count
 * @property-read mixed $sub_total
 * @property-read mixed $total
 * @property-read mixed $total_venta
 * @method static \Illuminate\Database\Eloquent\Builder|Compra delItem($item)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra delUser($user = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra delUsuarioCrea($user = null)
 * @method static \Database\Factories\CompraFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra noTemporal()
 * @method static \Illuminate\Database\Query\Builder|Compra onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra query()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra temporal()
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFechaDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereOrdenCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereProveedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUsuarioCrea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereUsuarioRecibe($value)
 * @method static \Illuminate\Database\Query\Builder|Compra withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Compra withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $folio_almacen
 * @property-read mixed $anio
 * @property-read mixed $mes
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFolioAlmacen($value)
 * @property string|null $folio_inventario
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereFolioInventario($value)
 * @property string $descuento
 * @method static \Illuminate\Database\Eloquent\Builder|Compra whereDescuento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compra noAnuladas()
 */
class Compra extends Model
{
    use SoftDeletes;

    use HasFactory;

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
        'estado_id',
        'usuario_crea',
        'usuario_recibe',
        'observaciones',
        'orden_compra',
        'descuento',
        'folio_almacen',
        'folio_inventario',
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
        'estado_id' => 'integer',
        'usuario_crea' => 'integer',
        'usuario_recibe' => 'integer',
        'observaciones' => 'string',
        'orden_compra' => 'string',
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
        'estado_id' => 'nullable',
        'usuario_crea' => 'nullable',
        'usuario_recibe' => 'nullable',
        'observaciones' => 'nullable|string',
        'orden_compra' => 'nullable|string',
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
        return $this->detalles->sum(function ($det){
            return $det->cantidad*$det->precio;
        });
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

        $this->estado_id = CompraEstado::RECIBIDA;
//        $this->fecha_ingreso = hoyDb();
        $this->save();

        $this->actualizaPreciosItem();
    }

    public function procesarKardex()
    {

        /**
         * @var CompraDetalle $detalle
         */
        foreach ($this->detalles as $index => $detalle) {
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
        $q->where('estado_id','!=',CompraEstado::ANULADA);
    }


    public function anular()
    {
        $this->estado_id = CompraEstado::ANULADA;
        $this->save();


        /**
         * @var CompraDetalle $detalle
         */
        foreach ($this->detalles as $detalle){
            $detalle->anular();
        }
    }


    public function tiene1h()
    {
        return $this->compra1hs->count() > 0;
    }

    public function estaRecibida()
    {
        return $this->estado_id==CompraEstado::RECIBIDA;
    }

    public function puedeAnular()
    {
        return $this->estado_id != CompraEstado::ANULADA && $this->estado_id == CompraEstado::RECIBIDA;
    }

    public function puedeCancelar()
    {
        return $this->estado_id == CompraEstado::CREADA;
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
            CompraEstado::CREADA,
            CompraEstado::RECIBIDA
        ]);
    }
}
