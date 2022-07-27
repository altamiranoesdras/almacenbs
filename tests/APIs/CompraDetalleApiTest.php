<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CompraDetalle;

class CompraDetalleApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_compra_detalle()
    {
        $compraDetalle = CompraDetalle::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/compra_detalles', $compraDetalle
        );

        $this->assertApiResponse($compraDetalle);
    }

    /**
     * @test
     */
    public function test_read_compra_detalle()
    {
        $compraDetalle = CompraDetalle::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/compra_detalles/'.$compraDetalle->id
        );

        $this->assertApiResponse($compraDetalle->toArray());
    }

    /**
     * @test
     */
    public function test_update_compra_detalle()
    {
        $compraDetalle = CompraDetalle::factory()->create();
        $editedCompraDetalle = CompraDetalle::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/compra_detalles/'.$compraDetalle->id,
            $editedCompraDetalle
        );

        $this->assertApiResponse($editedCompraDetalle);
    }

    /**
     * @test
     */
    public function test_delete_compra_detalle()
    {
        $compraDetalle = CompraDetalle::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/compra_detalles/'.$compraDetalle->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/compra_detalles/'.$compraDetalle->id
        );

        $this->response->assertStatus(404);
    }
}
