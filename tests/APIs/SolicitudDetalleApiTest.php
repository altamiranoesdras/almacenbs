<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SolicitudDetalle;

class SolicitudDetalleApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_solicitud_detalle()
    {
        $solicitudDetalle = SolicitudDetalle::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/solicitud_detalles', $solicitudDetalle
        );

        $this->assertApiResponse($solicitudDetalle);
    }

    /**
     * @test
     */
    public function test_read_solicitud_detalle()
    {
        $solicitudDetalle = SolicitudDetalle::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/solicitud_detalles/'.$solicitudDetalle->id
        );

        $this->assertApiResponse($solicitudDetalle->toArray());
    }

    /**
     * @test
     */
    public function test_update_solicitud_detalle()
    {
        $solicitudDetalle = SolicitudDetalle::factory()->create();
        $editedSolicitudDetalle = SolicitudDetalle::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/solicitud_detalles/'.$solicitudDetalle->id,
            $editedSolicitudDetalle
        );

        $this->assertApiResponse($editedSolicitudDetalle);
    }

    /**
     * @test
     */
    public function test_delete_solicitud_detalle()
    {
        $solicitudDetalle = SolicitudDetalle::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/solicitud_detalles/'.$solicitudDetalle->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/solicitud_detalles/'.$solicitudDetalle->id
        );

        $this->response->assertStatus(404);
    }
}
