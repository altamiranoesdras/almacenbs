<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $key
 * @property string $value
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserConfiguration withoutTrashed()
 * @mixin \Eloquent
 */
class UserConfiguration extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'user_configurations';

    public $fillable = [
        'user_id',
        'key',
        'value',
        'descripcion'
    ];

    protected $casts = [
        'key' => 'string',
        'value' => 'string',
        'descripcion' => 'string'
    ];

    public static $rules = [
        'user_id' => 'required',
        'key' => 'required|string|max:255',
        'value' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
