<?php

namespace App\Http\Requests;

use App\Models\CompraRequicicionTipoAdquisicion;
use Illuminate\Foundation\Http\FormRequest;

class CreateCompraRequicicionTipoAdquisicionRequest extends FormRequest
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
        return CompraRequicicionTipoAdquisicion::$rules;
    }

    public function messages()
    {
        return CompraRequicicionTipoAdquisicion::$messages;
    }
}
