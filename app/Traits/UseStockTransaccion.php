<?php


namespace App\Traits;


use App\Models\StockTransaccion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use function PHPUnit\Framework\isNull;

/**
 * Class CompraDetalle
 * @package App\Models
 * @version July 27, 2022, 12:22 pm CST
 *
 * @property Collection $transaccionesStock
 */
trait UseStockTransaccion
{
    /**
     * Set the polymorphic relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function transaccionesStock(): MorphMany
    {
        return $this->morphMany(StockTransaccion::class, 'model');
    }

    public function ingresos()
    {
        return $this->transaccionesStock()->where('tipo',StockTransaccion::INGRESO)->get();
    }

    public function egresos()
    {
        return $this->transaccionesStock()->where('tipo',StockTransaccion::EGRESO)->get();
    }

    public function addStockTransaccion($tipo,$stockId,$cantidad,$precioCosto=0)
    {
        $transaccion = new StockTransaccion([
            'stock_id' => $stockId,
            'tipo' => $tipo,
            'cantidad' => $cantidad,
            'precio_costo' => $precioCosto ?? 0,
        ]);

        $model = $this->getModel();

        if ($model->exists) {
            $this->transaccionesStock()->save($transaccion);
            $model->load('transaccionesStock');
        } else {
            $class = \get_class($model);

            $class::saved(
                function ($object) use ($transaccion, $model) {
                    static $modelLastFiredOn;
                    if ($modelLastFiredOn !== null && $modelLastFiredOn === $model) {
                        return;
                    }
                    $object->transaccionesStock()->sync($transaccion, false);
                    $object->load('transaccionesStock');
                    $modelLastFiredOn = $object;
                });
        }

        return $this;
    }

    /**
     * Revoke the given role from the model.
     *
     * @param string|\Spatie\Permission\Contracts\Role $role
     */
    public function deleteTransaccion($transacion)
    {
        $this->transaccionesStock()->delete($transacion);

        $this->load('transaccionesStock');

        return $this;
    }
}
