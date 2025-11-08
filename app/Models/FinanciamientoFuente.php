<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinanciamientoFuente extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'financiamiento_fuentes';

    public $fillable = [
        'codigo_fuente',
        'codigo_organismo',
        'correlativo',
        'nombre'
    ];

    protected $casts = [
        'codigo_fuente' => 'string',
        'codigo_organismo' => 'string',
        'correlativo' => 'string',
        'nombre' => 'string'
    ];

    public static $rules = [
        'codigo_fuente' => 'required|string|max:255',
        'codigo_organismo' => 'nullable|string|max:255',
        'correlativo' => 'nullable|string|max:255',
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    
}
