<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class Item
 *
 * @package App\Models
 * @version July 27, 2022, 12:22 pm CST
 * @property \App\Models\ItemCategoria $categoria
 * @property \App\Models\Renglon $renglon
 * @property \App\Models\Marca $marca
 * @property \App\Models\Unimed $unimed
 * @property \App\Models\ItemTipo $tipo
 * @property \Illuminate\Database\Eloquent\Collection $compra1hDetalles
 * @property \Illuminate\Database\Eloquent\Collection $compraDetalles
 * @property \Illuminate\Database\Eloquent\Collection $equivalencias
 * @property \Illuminate\Database\Eloquent\Collection $equivalencia1s
 * @property \Illuminate\Database\Eloquent\Collection $itemCategoria2s
 * @property \Illuminate\Database\Eloquent\Collection $itemsTraslados
 * @property \Illuminate\Database\Eloquent\Collection $itemsTraslado3s
 * @property \Illuminate\Database\Eloquent\Collection $kardexes
 * @property \Illuminate\Database\Eloquent\Collection $solicitudDetalles
 * @property \Illuminate\Database\Eloquent\Collection $stockIniciales
 * @property \Illuminate\Database\Eloquent\Collection $stocks
 * @property string $codigo
 * @property string $nombre
 * @property string $descripcion
 * @property integer $tipo_id
 * @property integer $renglon_id
 * @property integer $marca_id
 * @property integer $unimed_id
 * @property integer $categoria_id
 * @property number $precio_venta
 * @property number $precio_compra
 * @property number $precio_promedio
 * @property number $stock_minimo
 * @property number $stock_maximo
 * @property number $stock_total
 * @property string $ubicacion
 * @property boolean $perecedero
 * @property boolean $inventariable
 * @property int $id
 * @property string|null $codigo_insumo
 * @property int|null $presentacion_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemCategoria[] $categorias
 * @property-read int|null $categorias_count
 * @property-read int|null $compra1h_detalles_count
 * @property-read int|null $compra_detalles_count
 * @property-read int|null $equivalencia1s_count
 * @property-read int|null $equivalencias_count
 * @property-read mixed $img
 * @property-read mixed $text
 * @property-read mixed $thumb
 * @property-read int|null $kardexes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Kardex[] $kardexs
 * @property-read int|null $kardexs_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read int|null $solicitud_detalles_count
 * @property-read int|null $stocks_count
 * @method static \Illuminate\Database\Eloquent\Builder|Item deCategoria($categoria)
 * @method static \Illuminate\Database\Eloquent\Builder|Item deMarca($marca)
 * @method static \Database\Factories\ItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Query\Builder|Item onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item tipoActivo()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCodigoInsumo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereInventariable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereMarcaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePerecedero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePrecioCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePrecioPromedio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePrecioVenta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePresentacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereRenglonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereStockMaximo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereStockMinimo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUbicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUnimedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Item withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Item withoutAppends()
 * @method static \Illuminate\Database\Query\Builder|Item withoutTrashed()
 * @mixin \Eloquent
 * @property-read int|null $items_traslado3s_count
 * @property-read int|null $items_traslados_count
 * @property-read int|null $stock_iniciales_count
 * @property string|null $codigo_presentacion
 * @property-read \App\Models\ItemPresentacion|null $presentacion
 * @method static \Illuminate\Database\Eloquent\Builder|Item conIngresos()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCodigoPresentacion($value)
 * @property-read mixed $stock_bodega
 * @property int|null $modelo_id
 * @property-read mixed $texto_libro_almacen
 * @property-read mixed $texto_principal
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereModeloId($value)
 * @property-read mixed $texto_kardex
 * @property-read mixed $texto_requisicion
 */
class Item extends Model implements HasMedia
{
    use SoftDeletes,InteractsWithMedia;

    use HasFactory;

    public $table = 'items';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends= ['text','texto_libro_almacen',"texto_principal",'img','thumb','stock_total','stock_bodega'];

    protected $with = ['unimed','marca','stocks','media','presentacion','renglon'];

    public static $withoutAppends = false;

    public function scopeWithoutAppends($query)
    {
        self::$withoutAppends = true;

        return $query;
    }

    protected function getArrayableAppends()
    {
        if (self::$withoutAppends){
            return [];
        }

        return parent::getArrayableAppends();
    }



    public $fillable = [
        'codigo',
        'codigo_insumo',
        'codigo_presentacion',
        'nombre',
        'descripcion',
        'tipo_id',
        'renglon_id',
        'marca_id',
        'unimed_id',
        'presentacion_id',
        'categoria_id',
        'precio_venta',
        'precio_compra',
        'precio_promedio',
        'stock_minimo',
        'stock_maximo',
        'ubicacion',
        'inventariable',
        'perecedero'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'codigo' => 'string',
        'nombre' => 'string',
        'descripcion' => 'string',
        'tipo_id' => 'integer',
        'renglon_id' => 'integer',
        'marca_id' => 'integer',
        'unimed_id' => 'integer',
        'categoria_id' => 'integer',
        'precio_venta' => 'decimal:4',
        'precio_compra' => 'decimal:4',
        'precio_promedio' => 'decimal:4',
        'stock_minimo' => 'decimal:6',
        'stock_maximo' => 'decimal:6',
        'ubicacion' => 'string',
        'perecedero' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'nullable|string|max:25',
        'nombre' => 'required|string|max:100',
        'descripcion' => 'nullable|string',
        'tipo_id' => 'required|integer',
        'renglon_id' => 'required|integer',
        'marca_id' => 'nullable|integer',
        'unimed_id' => 'nullable|integer',
        'categoria_id' => 'nullable|integer',
        'precio_venta' => 'nullable|numeric',
        'precio_compra' => 'required|numeric',
        'precio_promedio' => 'nullable|numeric',
        'stock_minimo' => 'nullable|numeric',
        'stock_maximo' => 'nullable|numeric',
        'ubicacion' => 'nullable|string|max:45',
        'perecedero' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function unimed()
    {
        return $this->belongsTo(\App\Models\Unimed::class, 'unimed_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function categoria()
    {
        return $this->belongsTo(\App\Models\ItemCategoria::class, 'categoria_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function renglon()
    {
        return $this->belongsTo(\App\Models\Renglon::class, 'renglon_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function marca()
    {
        return $this->belongsTo(\App\Models\Marca::class, 'marca_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipo()
    {
        return $this->belongsTo(\App\Models\ItemTipo::class, 'tipo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function compra1hDetalles()
    {
        return $this->hasMany(\App\Models\Compra1hDetalle::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function compraDetalles()
    {
        return $this->hasMany(\App\Models\CompraDetalle::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function equivalencias()
    {
        return $this->hasMany(\App\Models\Equivalencia::class, 'item_origen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function equivalencia1s()
    {
        return $this->hasMany(\App\Models\Equivalencia::class, 'item_destino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function categorias()
    {
        return $this->belongsToMany(\App\Models\ItemCategoria::class, 'item_has_categoria','item_id','categoria_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function itemsTraslados()
    {
        return $this->hasMany(\App\Models\ItemTraslado::class, 'item_destino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function itemsTraslado3s()
    {
        return $this->hasMany(\App\Models\ItemTraslado::class, 'item_origen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function kardexes()
    {
        return $this->hasMany(\App\Models\Kardex::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function solicitudDetalles()
    {
        return $this->hasMany(\App\Models\SolicitudDetalle::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stockIniciales()
    {
        return $this->hasMany(\App\Models\StockInicial::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stocks()
    {
        return $this->hasMany(\App\Models\Stock::class, 'item_id');
    }

    public function presentacion()
    {
        return $this->belongsTo(ItemPresentacion::class);
    }




    /**
     *MÉTODOS Y MUTADORES
     */

    /**
     * Verifica si el item esta en el detalle de una compra
     * @return bool
     */
    public function estaEnUnaCompra(){

        return $this->getEntradasStock() > 0 ? true : false;
    }

    /**
     * Verifica si el item esta en el detalle de una venta
     * @return bool
     */
    public function estaEnUnaSolicitud(){

        return $this->getSalidasStock() > 0 ? true : false;
    }

    public function getTextAttribute()
    {
        $codigo = $this->codigo ?? $this->codigo_insumo ?? '(sin codigo)';

        $presentacion =  '';
        $unidad =  '';

        if (($this->presentacion->nombre ?? null)){
            $presentacion .=  " ".$this->presentacion->nombre;
        }

        if (($this->unimed->nombre ?? null)) {
            $unidad .= " ".$this->unimed->nombre;
        }


        return "CI:".$codigo." CP:".$this->codigo_presentacion.' - '.$this->nombre.$presentacion.$unidad;
    }

    public function getTextoPrincipalAttribute()
    {

        $presentacion =  '';
        $unidad =  '';

        if (($this->presentacion->nombre ?? null)){
            $presentacion .=  " ".$this->presentacion->nombre;
        }

        if (($this->unimed->nombre ?? null)) {
            $unidad .= " ".$this->unimed->nombre;
        }

        $descripcion = str_replace('&nbsp;','',strip_tags($this->descripcion));

        return $this->nombre." - ".$descripcion.$presentacion.$unidad;
    }

    public function getTextoRequisicionAttribute()
    {

        $presentacion =  '';
        $unidad =  '';

        if (($this->presentacion->nombre ?? null)){
            $presentacion .=  " ".$this->presentacion->nombre;
        }

        if (($this->unimed->nombre ?? null)) {
            $unidad .= " ".$this->unimed->nombre;
        }

        $descripcion = str_replace('&nbsp;','',strip_tags($this->descripcion));

        if ($descripcion){
            $descripcion =  " - ".$descripcion;
        }

        return "CI: ".$this->codigo_insumo." - ".$this->nombre;
    }

    public function getTextoKardexAttribute()
    {

        $presentacion = $this->presentacion->nombre ?? '';
        $unidad = $this->unimed->nombre ?? '';

        if ($this->esGrupo100()){

            $texto = "Renglón ".$this->renglon->numero." - ".$this->nombre;

        }else{

            $texto = "CI: ".$this->codigo_insumo." CP: ".$this->codigo_presentacion." ".$this->nombre;
        }
        return str_limit($texto,100,'');
    }


    public function getTextoLibroAlmacenAttribute()
    {

        $presentacion = $this->presentacion->nombre ?? '';
        $unidad = $this->unimed->nombre ?? '';

//        return $this->nombre."-".$presentacion." - ".$unidad;
        return $this->nombre;
    }


    public function precioPromedio()
    {

        $promedio = $this->compraDetalles->sum('sub_total') / $this->compraDetalles->sum('cantidad');

        return round($promedio,2);
    }


    public function getImgAttribute()
    {
        $media = $this->getMedia('items')->last();
        return $media ? $media->getUrl() : asset('img/default.svg');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(270)
            ->height(270);
    }

    public function getThumbAttribute()
    {
        $media = $this->getMedia('items')->last();
        return $media ? $media->getUrl('thumb') : asset('img/default.svg');
    }

    public function relacionados($cantidad)
    {
        $items = Item::whereHas('categorias',function ($q){

            $q->whereIn('id',$this->categorias->pluck('id'));

        })->whereNotIn('id',[$this->id])->with(['media'])->web()->get();

        return $items->count() > 2 ? $items->random($cantidad) : $items->random($items->count());
    }




    /**
     *SCOPES
     */


    public function scopeConIngresos($q)
    {
        return $q->whereHas('compraDetalles');
    }

    public function scopeTipoActivo($q)
    {
        return $q->where('tipo_id',ItemTipo::ACTIVO_FIJO);
    }

    public function scopeDeCategoria($query,$categoria)
    {
        return $query->whereIn('id', function($q) use ($categoria){
            $q->select('item_id')->from('icategoria_item')->where('categoria_id',$categoria)->whereNull('deleted_at');
        });
    }

    public function scopeDeMarca($query,$marca)
    {
        return $query->where('marca_id', $marca);
    }


    public function esNuevo()
    {
        $crado = Carbon::parse($this->created_at);

        return config('app.dias_producto_es_nuevo') >= Carbon::now()->diffInDays($crado);
    }



    public function getStockCalculado()
    {
        $stock = 0;

        $stockIni = $this->getStockInicial();
        $totalCompras = $this->getEntradasStock();
        $totalVentas = $this->getSalidasStock();


        if ($this->inventariable)
            return ($stockIni+$totalCompras )- $totalVentas;
        else
            return $stockIni;
    }

    public function getStockInicial()
    {
        return $this->stocks->sortBy('fecha_ing')->first()->kardex->cantidad ?? 0;
    }

    public function getEntradasStock()
    {
        $ingresos = $this->compraDetalles->filter(function ($det){


            /**
             * @var CompraDetalle $det
             */
            if ($det->compra->estado_id==CompraEstado::RECIBIDA){
                return $det;
            }
        });

        return $ingresos->sum('cantidad');
    }

    public function getSalidasStock()
    {

        $egresos = $this->solicitudDetalles->filter(function (SolicitudDetalle $det){

            if ($det->solicitud && $det->solicitud->estado_id!=SolicitudEstado::ANULADA){
                return $det;
            }
        });

        return $egresos->sum('cantidad_despachada');

    }

    public function getStockSegunKardex()
    {
        $kardex = $this->kardexs;

        $saldo = 0;

        /**
         * @var Kardex $det
         */
        foreach ($kardex as $index => $det) {
                $saldo+=$det->ingreso;
                $saldo-=$det->salida;
        }

        return $saldo;
    }


    public function kardexs()
    {
        return $this->hasMany(Kardex::class,'item_id');
    }

    public function valorComparaStocks()
    {
        return valoresIgualesArray($this->getStockSegunKardex(),[(string) $this->stockTienda(), (string) $this->getStockCalculado()]);
    }

    public function puedeEditarNombre()
    {
        return !$this->estaEnUnaCompra() && !$this->estaEnUnaSolicitud();
    }

    public function puedeEditarStock()
    {
        return !$this->estaEnUnaCompra() && !$this->estaEnUnaSolicitud();
    }

    public function puedeEditarPrecioPromedio()
    {
        return $this->compraDetalles->count() == 0;
    }

    public function actualizaOregistraStcokInicial($cantidad,$fechaVence = null)
    {


        if(!$this->inventariable)
            return null;


        /**
         * @var Stock $stock
         */
        $stock =  $this->stocks
            ->where('precio_compra',$this->precio_compra)
            ->where('bodega_id',Bodega::PRINCIPAL)
            ->sortBy('orden_salida')
            ->sortBy('fecha_vence')
            ->sortBy('created_at')
            ->sortBy('id')
            ->first();



        if($stock){

            $stock->cantidad = $cantidad;
            $stock->cantidad_inicial = $cantidad;
            $stock->save();

        }else{

            $stock= Stock::create([
                'bodega_id' => Bodega::PRINCIPAL,
                'item_id' => $this->id,
                'lote' =>  null,
                'precio_compra' => $this->precio_compra,
                'fecha_vence' => $fechaVence,
                'cantidad' =>  $cantidad,
                'cantidad_inicial' =>  $cantidad,
                'orden_salida' => 0
            ]);

        }


        if ($stock->kardex){
            $stock->kardex()->update(['cantidad' => $cantidad]);
        }else{

            if ($cantidad > 0){
                $stock->kardex()->create([
                    'item_id' => $stock->item_id,
                    'cantidad' => $stock->cantidad,
                    'tipo' => Kardex::TIPO_INGRESO,
                    'codigo' => null,
                    'responsable' => 'Stock Inicial',
                    'usuario_id' => auth()->user()->id ?? User::PRINCIPAL
                ]);
            }
        }


        return $stock;

    }

    public function getStockTotalAttribute()
    {
        return $this->stocks->where('bodega_id',Bodega::PRINCIPAL)->sum('cantidad');
    }

    public function getStockBodegaAttribute()
    {
        $bodega = request()->bodega_id ?? auth()->user()->bodega_id ?? Bodega::PRINCIPAL;

        return $this->stocks->where('bodega_id',$bodega)->sum('cantidad');
    }

    public function esGrupo300()
    {
        return $this->renglon->numero >= 300 && $this->renglon->numero < 400;
    }

    //es grupo 200
    public function esGrupo200()
    {
        return $this->renglon->numero >= 200 && $this->renglon->numero < 300;
    }

    public function esGrupo100()
    {
        return $this->renglon->numero >= 100 && $this->renglon->numero < 200;
    }
}
