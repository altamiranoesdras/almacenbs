<?php

namespace App\Rules;

use App\Models\Compra;
use App\Models\CompraEstado;
use App\Models\CompraTipo;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueNumeroSerieNoAnulada implements ValidationRule
{
    public function __construct(
        protected ?int $ignoreId = null,
        protected ?string $serie = null,
        protected ?int $tipo = null
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // si el tipo es ACTA, no validar unicidad
        if ($this->tipo == CompraTipo::ACTA) {
            return;
        }

        if (!$this->serie) {
            return;
        }

        $exists = Compra::query()
            ->where('numero', $value)
            ->where('serie', $this->serie)
            // considerar solo las compras NO anuladas
            ->where(function ($q) {
                $q->whereNull('estado_id')
                    ->orWhere('estado_id', '!=', CompraEstado::ANULADO);
            })
            ->when($this->ignoreId, fn ($q) => $q->where('id', '!=', $this->ignoreId))
            ->exists();

        if ($exists) {
            $fail('Ya existe un ingreso almacén con el mismo número y serie (no anulado).');
        }
    }
}
