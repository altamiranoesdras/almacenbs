<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Class Option
 * @package App\Models
 * @version September 21, 2021, 3:53 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $roles
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property integer $option_id
 * @property string $nombre
 * @property string $ruta
 * @property string $descripcion
 * @property string $icono_l
 * @property string $icono_r
 * @property integer $orden
 * @property string $color
 * @property boolean $dev
 */
class Option extends Model
{

    use SoftDeletes;

    public $table = 'options';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const PANEL_DE_CONTROL =        1;
    const NUEVA_COMPRA_SOLA =       2;
    const NUEVA_COMPRA =            4;
    const PROVEEDORES =             5;
    const BUSCAR_COMPRAS =          6;
    const NUEVA_REQUISICION =       8;
    const MIS_REQUISICIONES =       9;
    const DESPACHAR_REQUISICION =   10;
    const BUSCAR_REQUISICION =      11;
    const NUEVO_ARTICULO =          14;
    const BUSCAR_ARTÍCULO =         15;
    const CATEGORIAS =              16;
    const UNIDADES_DE_MEDIDA =      17;
    const MARCAS =                  18;
    const MAGNITUDES =              19;
    const IMPORTAR_EXCEL =          20;
    const TRASLADO_ENTRE_UNIDADES = 21;
    const STOCK =                   24;
    const KARDEX =                  25;
    const ARTICULOS_A_VENCER =      26;
    const USUARIOS =                28;
    const ROLES =                   29;
    const PERMISOS =                30;
    const CONFIGURACIONES =         31;
    const AUTORIZAR_REQUISICION =   32;
    const APROBAR_REQISICION =      33;

    const INVENTARIOS =             34;
    const TARJETA_RESPONSABILIDAD = 35;
    const INGRESO_INVENTARIO_1H =   36;
    const SOLICITUD_CD_BIENES =     37;
    const REPORTES =                38;
    const RPT_BIENES_POR_UNIDAD =   39;


    protected $appends= ['active','visible_to_user','text','ruta_evaluada'];

    public $fillable = [
        'option_id',
        'nombre',
        'ruta',
        'descripcion',
        'icono_l',
        'icono_r',
        'orden',
        'color',
        'dev'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'option_id' => 'integer',
        'nombre' => 'string',
        'ruta' => 'string',
        'descripcion' => 'string',
        'icono_l' => 'string',
        'icono_r' => 'string',
        'orden' => 'integer',
        'color' => 'string',
        'dev' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'ruta' => 'required',
        'icono_l' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'option_role');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'option_user');
    }

    public function parent()
    {
        return $this->belongsTo(Option::class,'option_id','id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany(Option::class,'option_id','id')->orderBy('orden')->with('children');
    }

    public function hasChildren()
    {
        return $this->children->count()>0;
    }

    public function hasTreeview()
    {
        return $this->hasChildren() ? 'has-treeview' : '';
    }

    public function active()
    {
        if (!$this->ruta){
            return '';
        }
        return request()->route()->getName() == $this->ruta ? 'active' : '';
    }

    public function openTreeView($children=null)
    {

        return $this->allDescendant()->contains('active','active') ? 'menu-open' : '';

    }

    public function allDescendant($children=null,$all=null)
    {
        $all = $all ?? collect();

        $children = $children ?? $this->children;

        foreach ($children as $child){
            $all = $all->push($child);
            if ($child->children->count()>0){
                $this->allDescendant($child->children,$all);
            }
        }

        return $all;
    }

    public function getActiveAttribute()
    {
        return $this->active();
    }

    public function getVisibleToUserAttribute()
    {
        if (Auth::user()){

            return is_null($this->option_id) || Auth::user()->getAllOptions()->contains('id',$this->id);
        }

        return false;
    }

    public function scopePadres($query)
    {
        return $query->whereNull('options.option_id')->orderBy('orden');
    }

    public function scopePadresDe($query,$chidres)
    {
        return $query->whereHas('children',function ($q)use ($chidres){
            $q->whereIn('id',$chidres);
        });
    }

    public function isChildren()
    {
        return !is_null($this->option_id);
    }

    public function getTextAttribute()
    {
        return $this->nombre;
    }

    public function getRutaEvaluadaAttribute()
    {
        return rutaOpcion($this);
    }
}
