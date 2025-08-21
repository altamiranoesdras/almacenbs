<?php

namespace App\Http\Requests\Update\CompraRequisicion;

use App\Models\CompraRequisicion\CompraRequisicion;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompraRequisicionRequest extends FormRequest
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
        $rules = CompraRequisicion::$rules;

        return $rules;
    }

    public function messages()
    {
        return CompraRequisicion::$messages;
    }
}
