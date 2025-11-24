<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompraRequisicionAnalistaCompraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tipo_proceso_id'     => 'required|integer',
            'tipo_adquisicion_id' => 'required|integer',
            'numero_npg'          => 'nullable|string',
            'numero_nog'          => 'nullable|string',
            'concurso_id'         => 'required|integer',
            'proveedor_id'        => 'required|integer',
            'numero_adjudicacion' => 'required|string',
            'numero_orden_compra'       => 'nullable|string',
            'orden_compra'      => 'nullable|file',
        ];
    }
}
