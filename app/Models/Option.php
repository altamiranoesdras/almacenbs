<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Option
 *
 * @property int $id
 * @property int|null $option_id opcion padre
 * @property string $nombre
 * @property string|null $ruta
 * @property string|null $descripcion
 * @property string $icono_l
 * @property string|null $icono_r
 * @property int|null $orden
 * @property string|null $color
 * @property int $recursos
 * @property bool $dev
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Option[] $children
 * @property-read int|null $children_count
 * @property-read mixed $active
 * @property-read mixed $ruta_evaluada
 * @property-read mixed $text
 * @property-read mixed $visible_to_user
 * @property-read Option|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option newQuery()
 * @method static \Illuminate\Database\Query\Builder|Option onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Option padres()
 * @method static \Illuminate\Database\Eloquent\Builder|Option padresDe($chidres)
 * @method static \Illuminate\Database\Eloquent\Builder|Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereDev($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereIconoL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereIconoR($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereOrden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereRecursos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereRuta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Option withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Option withoutTrashed()
 * @mixin \Eloquent
 */
class Option extends Model
{

    use SoftDeletes;

    public $table = 'options';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    const DASHBOARD =  1;
    const ADMIN =  2;
    const USUARIOS =  3;
    const ROLES =  4;
    const PERMISOS =  5;
    const CONFIGURACIONES =  6;
    const DEVELOPER =  7;
    const PRUEBA_APIS =  8;
    const CONFIGURACIONES_DEV =  9;
    const MENU =  11;
    const PRUEBAS =  12;

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
        'recursos',
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

        $tieneIndex = str_contains($this->ruta,'index');


        if ($this->recursos && $tieneIndex){
            $ruta = str_replace("index","*",$this->ruta);
            return request()->routeIs($ruta)  ? 'active' : '';
        }else{
            return request()->routeIs($this->ruta)  ? 'active' : '';
        }

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


