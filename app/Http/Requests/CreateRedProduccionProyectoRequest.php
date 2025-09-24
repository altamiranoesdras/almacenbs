<?php

namespace App\Http\Requests;

use App\Models\RedProduccionProyecto;
use Illuminate\Foundation\Http\FormRequest;

class CreateRedProduccionProyectoRequest extends FormRequest
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
        return RedProduccionProyecto::$rules;
    }

    public function messages()
    {
        return RedProduccionProyecto::$messages;
    }
}
