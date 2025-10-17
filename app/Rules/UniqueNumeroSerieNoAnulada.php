<?php

namespace App\Rules;

use App\Models\Compra;
use App\Models\CompraEstado;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueNumeroSerieNoAnulada implements ValidationRule
{
    public function __construct(
        protected ?int $ignoreId = null,
        protected ?string $serie = null,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->serie) {
            $fail('La serie es obligatoria para validar la unicidad.');
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
