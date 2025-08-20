<?php

namespace App\Http\Requests;

use App\Models\CompraBandeja;
use Illuminate\Foundation\Http\FormRequest;

class CreateCompraBandejaRequest extends FormRequest
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
        return CompraBandeja::$rules;
    }

    public function messages()
    {
        return CompraBandeja::$messages;
    }
}
