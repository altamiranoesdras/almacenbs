<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class AyudaVideo extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'ayuda_videos';

    public $fillable = [
        'titulo',
        'descripcion'
    ];

    protected $casts = [
        'titulo' => 'string',
        'descripcion' => 'string'
    ];

    public static $rules = [
        'titulo' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    
}
