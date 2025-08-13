<?php

namespace App\Http\Requests;

use App\Models\RrhhUnidad;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRrhhUnidadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = RrhhUnidad::$rules;

        unset($rules['codigo']);

        return $rules;
    }
}
