<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Kardex
 *
 * @package App\Models
 * @version July 27, 2022, 12:24 pm CST
 * @property \App\Models\Item $item
 * @property \App\Models\User $usuario
 * @property integer $item_id
 * @property integer $model_id
 * @property integer $folio
 * @property string $codigo_insumo
 * @property string $del
 * @property string $al
 * @property string $model_type
 * @property number $cantidad
 * @property string $tipo
 * @property string $codigo
 * @property string $responsable
 * @property string $observacion
 * @property boolean $impreso
 * @property integer $usuario_id
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $ingreso
 * @property-read mixed $salida
 * @property-read Model|\Eloquent $model
 * @method static Builder|Kardex delItem($item)
 * @method static Builder|Kardex inventariable()
 * @method static Builder|Kardex newModelQuery()
 * @method static Builder|Kardex newQuery()
 * @method static \Illuminate\Database\Query\Builder|Kardex onlyTrashed()
 * @method static Builder|Kardex query()
 * @method static Builder|Kardex whereCantidad($value)
 * @method static Builder|Kardex whereCodigo($value)
 * @method static Builder|Kardex whereCreatedAt($value)
 * @method static Builder|Kardex whereDeletedAt($value)
 * @method static Builder|Kardex whereFolio($value)
 * @method static Builder|Kardex whereId($value)
 * @method static Builder|Kardex whereImpreso($value)
 * @method static Builder|Kardex whereItemId($value)
 * @method static Builder|Kardex whereModelId($value)
 * @method static Builder|Kardex whereModelType($value)
 * @method static Builder|Kardex whereObservacion($value)
 * @method static Builder|Kardex whereResponsable($value)
 * @method static Builder|Kardex whereTipo($value)
 * @method static Builder|Kardex whereUpdatedAt($value)
 * @method static Builder|Kardex whereUsuarioId($value)
 * @method static \Illuminate\Database\Query\Builder|Kardex withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Kardex withoutTrashed()
 * @mixin \Eloquent
 * @property-read mixed $precio
 */
class Kardex extends Model
{
    use SoftDeletes;

//    use HasFactory;

    public $table = 'kardexs';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const TIPO_INGRESO = 'ingreso';
    const TIPO_SALIDA = 'salida';


    protected $dates = ['deleted_at'];

    protected $appends = ['precio'];

    protected static function booted()
    {
        static::created(function (Kardex $kardex) {
            $kardex->folio = $kardex->siguienteFolio();
            $kardex->save();
        });
    }



    public $fillable = [
        'item_id',
        'model_id',
        'model_type',
        'folio',
        'codigo_insumo',
        'del',
        'al',
        'cantidad',
        'tipo',
        'codigo',
        'responsable',
        'observacion',
        'impreso',
        'usuario_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'item_id' => 'integer',
        'model_id' => 'integer',
        'model_type' => 'string',
        'cantidad' => 'decimal:2',
        'tipo' => 'string',
        'codigo' => 'string',
        'responsable' => 'string',
        'observacion' => 'string',
        'impreso' => 'boolean',
        'usuario_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'item_id' => 'required',
        'model_id' => 'required|integer',
        'model_type' => 'required|string|max:255',
        'cantidad' => 'required|numeric',
        'tipo' => 'required|string',
        'codigo' => 'nullable|string|max:255',
        'responsable' => 'nullable|string|max:255',
        'observacion' => 'nullable|string',
        'impreso' => 'nullable|boolean',
        'usuario_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }



    public function model()
    {
        return $this->morphTo();
    }

    public function getSalidaAttribute()
    {
        return $this->tipo==self::TIPO_SALIDA ? $this->cantidad : null;
    }


    public function getIngresoAttribute()
    {
        return $this->tipo==self::TIPO_INGRESO ? $this->cantidad : null;
    }


    public function scopeInventariable($q)
    {
        return $q->whereHas('item' ,function (Builder $q){
            $q->where('inventariable' ,1);
        });
    }


    public function getPrecioAttribute()
    {
        return $this->item->precio_compra;

    }

    public function scopeDelItem($q,$item)
    {
        $q->where('item_id',$item);
    }





    public function siguienteFolio()
    {


        $maximoFolio = self::whereRaw('year(created_at) ='.Carbon::now()->year)->max('folio');

        $folioItem = self::delItem($this->item_id)->whereRaw('year(created_at) ='.Carbon::now()->year)->max('folio');


        //si ele item no tiene folio
        if (!$folioItem){

            if (!$maximoFolio){
                $folioItem = 1;
            }else{
                $folioItem = $maximoFolio + 1;
            }

        }else{

            //cantidad de registros con el mimsmo folio y mismo item
            $cantidad = self::delItem($this->item_id)->where('folio',$folioItem)->get()->count();

            if ($cantidad >= 30){
                $folioItem = $maximoFolio+1;
            }
        }

        $txt = "Item: ".$this->item_id." Folio: ".$folioItem. " Max: ".$maximoFolio;

//        dump($txt);


        return $folioItem;
    }
}
