<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserConfiguration extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'user_configurations';

    public $fillable = [
        'user_id',
        'key',
        'value',
        'description'
    ];

    protected $casts = [
        'key' => 'string',
        'value' => 'string',
        'description' => 'string'
    ];

    public static $rules = [
        'user_id' => 'required',
        'key' => 'required|string|max:255',
        'value' => 'required|string|max:255',
        'description' => 'nullable|string|max:65535',
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
