<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StockTransaccion;

class StockTransaccionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stock_transaccion()
    {
        $stockTransaccion = StockTransaccion::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/stock_transaccions', $stockTransaccion
        );

        $this->assertApiResponse($stockTransaccion);
    }

    /**
     * @test
     */
    public function test_read_stock_transaccion()
    {
        $stockTransaccion = StockTransaccion::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/stock_transaccions/'.$stockTransaccion->id
        );

        $this->assertApiResponse($stockTransaccion->toArray());
    }

    /**
     * @test
     */
    public function test_update_stock_transaccion()
    {
        $stockTransaccion = StockTransaccion::factory()->create();
        $editedStockTransaccion = StockTransaccion::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/stock_transaccions/'.$stockTransaccion->id,
            $editedStockTransaccion
        );

        $this->assertApiResponse($editedStockTransaccion);
    }

    /**
     * @test
     */
    public function test_delete_stock_transaccion()
    {
        $stockTransaccion = StockTransaccion::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/stock_transaccions/'.$stockTransaccion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/stock_transaccions/'.$stockTransaccion->id
        );

        $this->response->assertStatus(404);
    }
}
