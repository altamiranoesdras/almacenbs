<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CompraEstado;

class CompraEstadoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_compra_estado()
    {
        $compraEstado = CompraEstado::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/compra_estados', $compraEstado
        );

        $this->assertApiResponse($compraEstado);
    }

    /**
     * @test
     */
    public function test_read_compra_estado()
    {
        $compraEstado = CompraEstado::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/compra_estados/'.$compraEstado->id
        );

        $this->assertApiResponse($compraEstado->toArray());
    }

    /**
     * @test
     */
    public function test_update_compra_estado()
    {
        $compraEstado = CompraEstado::factory()->create();
        $editedCompraEstado = CompraEstado::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/compra_estados/'.$compraEstado->id,
            $editedCompraEstado
        );

        $this->assertApiResponse($editedCompraEstado);
    }

    /**
     * @test
     */
    public function test_delete_compra_estado()
    {
        $compraEstado = CompraEstado::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/compra_estados/'.$compraEstado->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/compra_estados/'.$compraEstado->id
        );

        $this->response->assertStatus(404);
    }
}
