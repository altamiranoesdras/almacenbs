<?php

namespace App\Http\Requests;

use App\Models\CompraSolicitud;
use Arr;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompraSolicitudRequest extends FormRequest
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
        $rules = CompraSolicitud::$rules;

        $rules = Arr::except($rules, ['estado_id', 'usuario_solicita']);

        return $rules;
    }

    public function messages()
    {
        return CompraSolicitud::$messages;
    }
}
