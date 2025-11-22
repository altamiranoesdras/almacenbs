<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Stock
 *
 * @property int $id
 * @property int $item_id
 * @property int|null $unidad_id sirve para saber el stock que la unidad tiene como limite para poder requerir
 * @property int|null $bodega_id despues que la unidad haga el requerimiento, se traslada a la bodega de la unidad
 * @property string|null $lote
 * @property \Illuminate\Support\Carbon $fecha_ing
 * @property \Illuminate\Support\Carbon|null $fecha_vence
 * @property string $precio_compra
 * @property string $cantidad
 * @property string $cantidad_inicial
 * @property bool $orden_salida
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bodega|null $bodega
 * @property-read mixed $codigo
 * @property-read mixed $color_vence
 * @property-read mixed $responsable
 * @property-read mixed $sub_total
 * @property-read mixed $texto_vence
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\Kardex|null $kardex
 * @property-read \App\Models\RrhhUnidad|null $rrhhUnidad
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockTransaccion> $transaccion
 * @property-read int|null $transaccion_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockTransaccion> $transcciones
 * @property-read int|null $transcciones_count
 * @method static Builder|Stock conIngresos()
 * @method static Builder|Stock conStock()
 * @method static Builder|Stock deBodega($bodega = null)
 * @method static \Database\Factories\StockFactory factory($count = null, $state = [])
 * @method static Builder|Stock newModelQuery()
 * @method static Builder|Stock newQuery()
 * @method static Builder|Stock onlyTrashed()
 * @method static Builder|Stock quedanMeses($meses, $vencidos = false)
 * @method static Builder|Stock query()
 * @method static Builder|Stock vencidos()
 * @method static Builder|Stock whereBodegaId($value)
 * @method static Builder|Stock whereCantidad($value)
 * @method static Builder|Stock whereCantidadInicial($value)
 * @method static Builder|Stock whereCreatedAt($value)
 * @method static Builder|Stock whereDeletedAt($value)
 * @method static Builder|Stock whereFechaIng($value)
 * @method static Builder|Stock whereFechaVence($value)
 * @method static Builder|Stock whereId($value)
 * @method static Builder|Stock whereItemId($value)
 * @method static Builder|Stock whereLote($value)
 * @method static Builder|Stock whereOrdenSalida($value)
 * @method static Builder|Stock wherePrecioCompra($value)
 * @method static Builder|Stock whereUnidadId($value)
 * @method static Builder|Stock whereUpdatedAt($value)
 * @method static Builder|Stock withTrashed()
 * @method static Builder|Stock withoutTrashed()
 * @mixin \Eloquent
 */
class Stock extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'stocks';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends =['sub_total'];

    protected $with = ['bodega'];


    public $fillable = [
        'item_id',
        'unidad_id',
        'bodega_id',
        'lote',
        'fecha_ing',
        'fecha_vence',
        'precio_compra',
        'cantidad',
        'cantidad_inicial',
        'orden_salida'
    ];

    protected $casts = [
        'id' => 'integer',
        'item_id' => 'integer',
        'unidad_id' => 'integer',
        'bodega_id' => 'integer',
        'lote' => 'string',
        'fecha_ing' => 'datetime',
        'fecha_vence' => 'date',
        'precio_compra' => 'decimal:2',
        'cantidad' => 'decimal:2',
        'cantidad_inicial' => 'decimal:2',
        'orden_salida' => 'boolean'
    ];

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


    //---RELACIONES---

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    public function bodega()
    {
        return $this->belongsTo(\App\Models\Bodega::class, 'bodega_id');
    }

    /**
     * @return HasMany
     **/
    public function transaccion()
    {
        return $this->hasMany(StockTransaccion::class, 'stock_id');
    }

    public function transcciones(): Stock|Builder|HasMany
    {
        return $this->hasMany(StockTransaccion::class, 'stock_id');

    }

    public function kardex()
    {
        return $this->morphOne(Kardex::class,'model');
    }


    //---SCOPES---

    public function scopeConIngresos($query)
    {
        $query->whereHas('item',function ($q){
            $q->conIngresos();
        });
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

    public function scopeQuedanMeses($query,$meses,$vencidos=false){

        $fechaFin = Carbon::now()->addMonth($meses)->format('Y-m-d');
        $fechaIni = Carbon::now()->format('Y-m-d');

        $query->conStock()->whereBetween('fecha_vence',[$fechaIni,$fechaFin]);

        if ($vencidos){
            $query->vencidos();
        }

        return $query;
    }

    public function scopeDeBodega($query,$bodega=null){

        $bodega = $bodega ?? session('bodega');

        return $query->where('bodega_id',$bodega);
    }



    //---MUTADORES---

    public function getCodigoAttribute()
    {
        return $this->lote ?? $this->id;
    }

    public function getResponsableAttribute()
    {
        return 'STOCK INICIAL';
    }

    public function getSubTotalAttribute()
    {
        return $this->precio_compra * $this->cantidad;
    }

    public function getTextoVenceAttribute()
    {
        $hoy = \Carbon\Carbon::now();
        $fechaVen = \Carbon\Carbon::parse($this->fecha_vence);

        if ($fechaVen->isFuture()) {
            // Si aún no ha vencido
            $meses = $hoy->diffInMonths($fechaVen);
            $dias = $hoy->copy()->addMonths($meses)->diffInDays($fechaVen);

            if ($meses > 0) {
                return 'vence en ' .$meses . ' ' . ($meses == 1 ? 'mes' : 'meses');
            } else {
                return 'vence en ' .$dias . ' ' . ($dias == 1 ? 'día' : 'días');
            }
        } else {
            // Si ya venció
            $meses = $fechaVen->diffInMonths($hoy);
            $dias = $fechaVen->copy()->addMonths($meses)->diffInDays($hoy);

            if ($meses > 0) {
                return 'venció hace ' . $meses . ' ' . ($meses == 1 ? 'mes' : 'meses');
            } else {
                return 'venció hace ' . $dias . ' ' . ($dias == 1 ? 'día' : 'días');
            }
        }

    }

    public function getColorVenceAttribute()
    {
        $hoy = \Carbon\Carbon::now();
        $fechaVen = \Carbon\Carbon::parse($this->fecha_vence);

        if ($fechaVen->isFuture()) {
            // Si aún no ha vencido
            $meses = $hoy->diffInMonths($fechaVen);
            $dias = $hoy->copy()->addMonths($meses)->diffInDays($fechaVen);

            if ($meses >= 6) {
                return 'success'; // Verde
            } elseif ($meses >= 3) {
                return 'secondary'; // Amarillo
            } else {
                return 'warning'; // Rojo
            }
        } else {
            return 'danger'; // Rojo
        }
    }

    public function rrhhUnidad()
    {
        return $this->belongsTo(\App\Models\RrhhUnidad::class, 'unidad_id');
    }

    public function agregaKardex($responsable = 'STOCK INICIAL',$fecha=null)
    {
        if ($this->kardex) {
            $this->kardex->increment('cantidad', $this->cantidad);
            $this->kardex->created_at = $fecha ?? now();
            $this->kardex->save();
        } else {
            $this->kardex()->forceCreate([
                'categoria_id' => $this->item->categoria_id,
                'item_id' => $this->item_id,
                'cantidad' => $this->cantidad_inicial,
                'precio_existencia' => $this->precio_compra,
                'precio_movimiento' => $this->precio_compra,
                'tipo' => Kardex::TIPO_INGRESO,
                'codigo' => '',
                'responsable' => $responsable,
                'usuario_id' => usuarioAutenticado()->id, // Usuario principal
                'folio_siguiente' => '',
                'created_at' => $fecha ?? now(),
            ]);
        }

    }
}
