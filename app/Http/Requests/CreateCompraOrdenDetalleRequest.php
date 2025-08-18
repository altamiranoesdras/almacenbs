<?php

namespace App\Http\Requests;

use App\Models\CompraOrdenDetalle;
use Illuminate\Foundation\Http\FormRequest;

class CreateCompraOrdenDetalleRequest extends FormRequest
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
        return CompraOrdenDetalle::$rules;
    }

    public function messages()
    {
        return CompraOrdenDetalle::$messages;
    }
}
