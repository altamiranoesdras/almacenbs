<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipio extends Model
{

    use SoftDeletes;
    use HasFactory;

    public $table = 'municipios';

    public $fillable = [
        'codigo',
        'nombre',
        'departamento_id'
    ];

    protected $casts = [
        'codigo' => 'string',
        'nombre' => 'string'
    ];

    public static $rules = [
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'departamento_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $messages = [

    ];

    public function departamento(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Departamento::class, 'departamento_id');
    }
}
