<?php

namespace App\Http\Requests;

use App\Models\CompraRequisicionProcesoTipo;
use Illuminate\Foundation\Http\FormRequest;

class CreateCompraRequisicionProcesoTipoRequest extends FormRequest
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
        return CompraRequisicionProcesoTipo::$rules;
    }

    public function messages()
    {
        return CompraRequisicionProcesoTipo::$messages;
    }
}
