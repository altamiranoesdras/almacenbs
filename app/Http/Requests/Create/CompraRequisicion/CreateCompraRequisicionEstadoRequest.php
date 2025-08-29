<?php

namespace App\Http\Requests\Create\CompraRequisicion;

use App\Models\CompraRequisicionEstado;
use Illuminate\Foundation\Http\FormRequest;

class CreateCompraRequisicionEstadoRequest extends FormRequest
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
        return CompraRequisicionEstado::$rules;
    }

    public function messages()
    {
        return CompraRequisicionEstado::$messages;
    }
}
