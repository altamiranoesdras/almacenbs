<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Stock
 * @package App\Models
 * @version July 27, 2022, 12:25 pm CST
 *
 * @property \App\Models\Item $item
 * @property \Illuminate\Database\Eloquent\Collection $stocksTransacciones
 * @property integer $item_id
 * @property string $lote
 * @property string|\Carbon\Carbon $fecha_ing
 * @property string $fecha_vence
 * @property number $precio_compra
 * @property number $cantidad
 * @property number $cantidad_inicial
 * @property boolean $orden_salida
 */
class Stock extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'stocks';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'item_id',
        'lote',
        'fecha_ing',
        'fecha_vence',
        'precio_compra',
        'cantidad',
        'cantidad_inicial',
        'orden_salida'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'item_id' => 'integer',
        'lote' => 'string',
        'fecha_ing' => 'datetime',
        'fecha_vence' => 'date',
        'precio_compra' => 'decimal:2',
        'cantidad' => 'decimal:2',
        'cantidad_inicial' => 'decimal:2',
        'orden_salida' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'item_id' => 'required',
        'lote' => 'nullable|string|max:25',
        'fecha_ing' => 'required',
        'fecha_vence' => 'nullable',
        'precio_compra' => 'required|numeric',
        'cantidad' => 'required|numeric',
        'cantidad_inicial' => 'required|numeric',
        'orden_salida' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function transaccion()
    {
        return $this->hasMany(\App\Models\StockTransaccion::class, 'stock_id');
    }


    public function scopeDeTienda($query,$tienda=null){

        $tienda = $tienda ?? session('tienda');

        return $query->where('tienda_id',$tienda);
    }

    public function scopeConStock($query)
    {
        $query->where('cantidad','>',0);
    }

    public function scopeVencidos($query)
    {
        $hoy = Carbon::now()->format('Y-m-d');

        return $query->orWhere('fecha_vence','<',$hoy)->conStock();
    }

    public function scopeQuedanMeses($query,$meses){

        $fechaFin = Carbon::now()->addMonth($meses)->format('Y-m-d');
        $fechaIni = Carbon::now()->format('Y-m-d');

        return $query->conStock()->whereBetween('fecha_vence',[$fechaIni,$fechaFin])->vencidos();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function ventaDetalles()
    {
        return $this->belongsToMany(\App\Models\VentaDetalle::class, 'egresos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function compraDetalles()
    {
        return $this->belongsToMany(\App\Models\CompraDetalle::class, 'ingresos');
    }

    public function solicitudEgresoDetalles()
    {
        return $this->belongsToMany(SolicitudDetalle::class, 'egreso_solicitud');
    }

    public function solicitudIngresoDetalles()
    {
        return $this->belongsToMany(SolicitudDetalle::class, 'ingreso_solicitud');
    }


    /**
     * Realiza un egreso del stock en base al orden de salida definido, si no esta definido un orden de salida egresa
     * los de menor fecha de vencimiento
     * @param null $item
     * @param int $cantida
     * @param null $detalleVenta
     * @param null $tienda
     * @param null $lote
     * @param null $fechaVence
     * @return array|bool
     */
    public function egreso($item=null,$cantida=0,$detalleVenta=null,$tienda=null){

        $cantida=$cantida*-1;

        //Sin no se envía la tienda se toma la de la sesión del usuario
//        $tienda = !$tienda ? Auth::user()->empleado->tienda->id : $tienda;
        $tienda = session('tienda') ?? request()->tienda ?? $tienda;

        $stocks = Stock::where('item_id',$item)
            ->where('tienda_id',$tienda)
            ->where('cantidad','>',0)
            ->orderBy('orden_salida')
            ->orderBy('fecha_vence')
            ->orderBy('created_at')
            ->orderBy('id')
            ->get();

        if($stocks){

            $egresos = collect();
            foreach ($stocks as $key => $stock) {

                $cantida=($cantida+$stock->cantidad);

                $nuevoStock = $cantida<0 ? 0 : $cantida;

                $rebajado= $cantida<=0 ? $stock->cantidad : ($cantida-$stock->cantidad)*-1;

//                    dump('cantida: '.$cantida.' nuevo stock: '.$nuevoStock.' rebajado:'.$rebajado);

                if($rebajado>0){
                    $egresos[]= [$detalleVenta => ['cantidad' => $rebajado]];
                    $stock->cantidad= $nuevoStock;

                    $stock->save();
                    if($detalleVenta){
                        $stock->ventaDetalles()->syncWithoutDetaching([$detalleVenta => ['cantidad' => $rebajado]]);
                    }
                }

                if($cantida>0)
                    break;
            }

            return $egresos;

        }else{

            return false;
        }


    }

    /**
     * Realiza un ingreso al stock, si existe un stock para el item en la tienda se suma a la cantidad existente si no,
     * se crea un nuevo registro
     * @param null $item
     * @param int $cantida
     * @param null $detalleCompra
     * @param null $lote
     * @param null $fechaVence
     * @param null $tienda
     * @return mixed
     */
    public function ingreso($item=null,$cantida=0,$detalleCompra=null,$lote=null,$fechaVence=null,$tienda=null){

        //Sin no se envía la tienda se toma la de la sesión del usuario
//        $tienda = !$tienda ? Auth::user()->empleado->tienda->id : $tienda;
        $tienda = session('tienda') ?? request()->tienda ?? $tienda;

        $stock = Stock::where('tienda_id',$tienda)
            ->where('item_id',$item)
            ->where('lote',$lote)
            ->where('fecha_vence',$fechaVence)
            ->get();

        //Si hay un registro existente
        if($stock->count() > 0){

            $stock= $stock[0];

            $stock->cantidad = $stock->cantidad + $cantida;
            $stock->save();
            if ($detalleCompra){
                $stock->compraDetalles()->syncWithoutDetaching([$detalleCompra => ['cantidad' => $cantida]]);
            }
        }

        //Si no hay ningún registro
        if($stock->count()==0){
            $datos = [
                'tienda_id' => $tienda,
                'item_id' => $item,
                'lote' =>  $lote,
                'fecha_vence' => $fechaVence,
                'cantidad' =>  $cantida,
                'cantidad_inicial' =>  $cantida,
                'orden_salida' => 0
            ];

            $stock= $this->create($datos);

            if ($detalleCompra){
                $stock->compraDetalles()->syncWithoutDetaching([$detalleCompra => ['cantidad' => $cantida]]);
            }
        }

        return $stock;

    }


    public function egresoSolicitud($item=null,$cantida=0,$detalleSolicitud=null,$tienda=null){

        $cantida=$cantida*-1;

        //Sin no se envía la tienda se toma la de la sesión del usuario
//        $tienda = !$tienda ? Auth::user()->empleado->tienda->id : $tienda;
        $tienda = session('tienda') ?? request()->tienda ?? $tienda;

        $stocks = Stock::where('item_id',$item)
            ->where('tienda_id',$tienda)
            ->where('cantidad','>',0)
            ->orderBy('orden_salida')
            ->orderBy('fecha_vence')
            ->orderBy('created_at')
            ->orderBy('id')
            ->get();

        if($stocks){

            $egresos = collect();
            foreach ($stocks as $key => $stock) {

                $cantida=($cantida+$stock->cantidad);

                $nuevoStock = $cantida<0 ? 0 : $cantida;

                $rebajado= $cantida<=0 ? $stock->cantidad : ($cantida-$stock->cantidad)*-1;

//                    dump('cantida: '.$cantida.' nuevo stock: '.$nuevoStock.' rebajado:'.$rebajado);

                if($rebajado>0){
                    $egresos[]= [$detalleSolicitud => ['cantidad' => $rebajado]];
                    $stock->cantidad= $nuevoStock;

                    $stock->save();
                    if($detalleSolicitud){
                        $stock->solicitudEgresoDetalles()->syncWithoutDetaching([$detalleSolicitud => ['cantidad' => $rebajado]]);
                    }
                }

                if($cantida>0)
                    break;
            }

            return $stock;

        }else{

            return false;
        }


    }

    public function ingresoSolicitud($item=null,$cantida=0,$detalleSolicitud=null,$lote=null,$fechaVence=null,$tienda=null){

        //Sin no se envía la tienda se toma la de la sesión del usuario
//        $tienda = !$tienda ? Auth::user()->empleado->tienda->id : $tienda;
        $tienda = session('tienda') ?? request()->tienda ?? $tienda;

        $stock = Stock::where('tienda_id',$tienda)
            ->where('item_id',$item)
            ->where('lote',$lote)
            ->where('fecha_vence',$fechaVence)
            ->get();

        //Si hay un registro existente
        if($stock->count() > 0){

            $stock= $stock[0];

            $stock->cantidad = $stock->cantidad + $cantida;
            $stock->save();
            if ($detalleSolicitud){
                $stock->solicitudIngresoDetalles()->syncWithoutDetaching([$detalleSolicitud => ['cantidad' => $cantida]]);
            }
        }

        //Si no hay ningún registro
        if($stock->count()==0){
            $datos = [
                'tienda_id' => $tienda,
                'item_id' => $item,
                'lote' =>  $lote,
                'fecha_vence' => $fechaVence,
                'cantidad' =>  $cantida,
                'cantidad_inicial' =>  $cantida,
                'orden_salida' => 0
            ];

            $stock= $this->create($datos);

            if ($detalleSolicitud){
                $stock->solicitudIngresoDetalles()->syncWithoutDetaching([$detalleSolicitud => ['cantidad' => $cantida]]);
            }
        }

        return $stock;

    }


    public function kardex()
    {
        return $this->morphOne(Kardex::class,'model');
    }


    public function getCodigoAttribute()
    {
        return $this->lote ?? $this->id;
    }

    public function getResponsableAttribute()
    {
        return 'STOCK INICIAL';
    }
}
