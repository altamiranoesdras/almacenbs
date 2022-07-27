<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Compra;

class CompraApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_compra()
    {
        $compra = Compra::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/compras', $compra
        );

        $this->assertApiResponse($compra);
    }

    /**
     * @test
     */
    public function test_read_compra()
    {
        $compra = Compra::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/compras/'.$compra->id
        );

        $this->assertApiResponse($compra->toArray());
    }

    /**
     * @test
     */
    public function test_update_compra()
    {
        $compra = Compra::factory()->create();
        $editedCompra = Compra::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/compras/'.$compra->id,
            $editedCompra
        );

        $this->assertApiResponse($editedCompra);
    }

    /**
     * @test
     */
    public function test_delete_compra()
    {
        $compra = Compra::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/compras/'.$compra->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/compras/'.$compra->id
        );

        $this->response->assertStatus(404);
    }
}
