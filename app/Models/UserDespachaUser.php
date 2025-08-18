<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UserDespachaUser
 *
 * @property int $user_sol
 * @property int $user_des
 * @property-read \App\Models\User $userDes
 * @property-read \App\Models\User $userSol
 * @method static \Database\Factories\UserDespachaUserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser whereUserDes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser whereUserSol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDespachaUser withoutTrashed()
 * @mixin \Eloquent
 */
class UserDespachaUser extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'user_despacha_user';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_des'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_sol' => 'integer',
        'user_des' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_des' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userSol()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_sol');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userDes()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_des');
    }
}
