<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Compra1hDetalle;

class Compra1hDetalleApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_compra1h_detalle()
    {
        $compra1hDetalle = Compra1hDetalle::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/compra1h_detalles', $compra1hDetalle
        );

        $this->assertApiResponse($compra1hDetalle);
    }

    /**
     * @test
     */
    public function test_read_compra1h_detalle()
    {
        $compra1hDetalle = Compra1hDetalle::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/compra1h_detalles/'.$compra1hDetalle->id
        );

        $this->assertApiResponse($compra1hDetalle->toArray());
    }

    /**
     * @test
     */
    public function test_update_compra1h_detalle()
    {
        $compra1hDetalle = Compra1hDetalle::factory()->create();
        $editedCompra1hDetalle = Compra1hDetalle::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/compra1h_detalles/'.$compra1hDetalle->id,
            $editedCompra1hDetalle
        );

        $this->assertApiResponse($editedCompra1hDetalle);
    }

    /**
     * @test
     */
    public function test_delete_compra1h_detalle()
    {
        $compra1hDetalle = Compra1hDetalle::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/compra1h_detalles/'.$compra1hDetalle->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/compra1h_detalles/'.$compra1hDetalle->id
        );

        $this->response->assertStatus(404);
    }
}
