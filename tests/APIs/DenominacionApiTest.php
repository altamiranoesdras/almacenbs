<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Denominacion;

class DenominacionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_denominacion()
    {
        $denominacion = Denominacion::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/denominacions', $denominacion
        );

        $this->assertApiResponse($denominacion);
    }

    /**
     * @test
     */
    public function test_read_denominacion()
    {
        $denominacion = Denominacion::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/denominacions/'.$denominacion->id
        );

        $this->assertApiResponse($denominacion->toArray());
    }

    /**
     * @test
     */
    public function test_update_denominacion()
    {
        $denominacion = Denominacion::factory()->create();
        $editedDenominacion = Denominacion::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/denominacions/'.$denominacion->id,
            $editedDenominacion
        );

        $this->assertApiResponse($editedDenominacion);
    }

    /**
     * @test
     */
    public function test_delete_denominacion()
    {
        $denominacion = Denominacion::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/denominacions/'.$denominacion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/denominacions/'.$denominacion->id
        );

        $this->response->assertStatus(404);
    }
}
