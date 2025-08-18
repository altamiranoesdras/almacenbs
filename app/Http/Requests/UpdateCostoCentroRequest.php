<?php

namespace App\Http\Requests;

use App\Models\CostoCentro;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCostoCentroRequest extends FormRequest
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
        $rules = CostoCentro::$rules;
        
        return $rules;
    }

    public function messages()
    {
        return CostoCentro::$messages;
    }
}
