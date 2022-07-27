<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Solicitud;

class SolicitudApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_solicitud()
    {
        $solicitud = Solicitud::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/solicituds', $solicitud
        );

        $this->assertApiResponse($solicitud);
    }

    /**
     * @test
     */
    public function test_read_solicitud()
    {
        $solicitud = Solicitud::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/solicituds/'.$solicitud->id
        );

        $this->assertApiResponse($solicitud->toArray());
    }

    /**
     * @test
     */
    public function test_update_solicitud()
    {
        $solicitud = Solicitud::factory()->create();
        $editedSolicitud = Solicitud::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/solicituds/'.$solicitud->id,
            $editedSolicitud
        );

        $this->assertApiResponse($editedSolicitud);
    }

    /**
     * @test
     */
    public function test_delete_solicitud()
    {
        $solicitud = Solicitud::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/solicituds/'.$solicitud->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/solicituds/'.$solicitud->id
        );

        $this->response->assertStatus(404);
    }
}
