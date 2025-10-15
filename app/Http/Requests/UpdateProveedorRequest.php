<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Proveedor;

class UpdateProveedorRequest extends FormRequest
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
        // Copia las reglas base del modelo
        $rules = Proveedor::$rules;

        // Sobrescribe la regla de 'nit' para ignorar el registro actual
        $rules['nit'] = 'required|string|max:20|unique:proveedores,nit,' . $this->proveedore;

        return $rules;
    }


}
