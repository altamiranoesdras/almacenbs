<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StockInicial;

class StockInicialApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stock_inicial()
    {
        $stockInicial = StockInicial::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/stock_inicials', $stockInicial
        );

        $this->assertApiResponse($stockInicial);
    }

    /**
     * @test
     */
    public function test_read_stock_inicial()
    {
        $stockInicial = StockInicial::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/stock_inicials/'.$stockInicial->id
        );

        $this->assertApiResponse($stockInicial->toArray());
    }

    /**
     * @test
     */
    public function test_update_stock_inicial()
    {
        $stockInicial = StockInicial::factory()->create();
        $editedStockInicial = StockInicial::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/stock_inicials/'.$stockInicial->id,
            $editedStockInicial
        );

        $this->assertApiResponse($editedStockInicial);
    }

    /**
     * @test
     */
    public function test_delete_stock_inicial()
    {
        $stockInicial = StockInicial::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/stock_inicials/'.$stockInicial->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/stock_inicials/'.$stockInicial->id
        );

        $this->response->assertStatus(404);
    }
}
