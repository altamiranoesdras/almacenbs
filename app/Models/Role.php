<?php

namespace App\Models;

/**
 * Class Role
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Option> $options
 * @property-read int|null $options_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role withoutPermission($permissions)
 * @mixin \Eloquent
 */
class Role extends \Spatie\Permission\Models\Role
{

    public $table = 'roles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const DEVELOPER =        1;
    const SUPERADMIN =       2;
    const ADMIN =            3;
    const General =          4;
    const JEFE_ALMACEN =     5;
    const JEFE_INVENTARIOS = 6;
    const ASISTENTE_CAJ =    7;

    const SOLICITANTE_REQUISICION_COMPRAS = 8;
    const APROBADOR_REQUISICION_COMPRAS = 9;
    const ADMINISTRADOR_REQUISICION_COMPRAS = 10;
    const SOLICITANTE_REQUISICION_ALMACEN = 11;
    const APROBADOR_REQUISICION_ALMACEN = 12;
    const ADMINISTRADOR_REQUISICION_ALMACEN = 13;

    const ROLES_ADMINS = [1,2,3];

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'guard_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'guard_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'guard_name' => 'nullable'
    ];

    public static $messages = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function options()

    {
        return $this->belongsToMany(\App\Models\Option::class, 'option_role')->with('children');
    }

}
