<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\RrhhUnidad;

class RrhhUnidadApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_rrhh_unidad()
    {
        $rrhhUnidad = RrhhUnidad::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/rrhh_unidads', $rrhhUnidad
        );

        $this->assertApiResponse($rrhhUnidad);
    }

    /**
     * @test
     */
    public function test_read_rrhh_unidad()
    {
        $rrhhUnidad = RrhhUnidad::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/rrhh_unidads/'.$rrhhUnidad->id
        );

        $this->assertApiResponse($rrhhUnidad->toArray());
    }

    /**
     * @test
     */
    public function test_update_rrhh_unidad()
    {
        $rrhhUnidad = RrhhUnidad::factory()->create();
        $editedRrhhUnidad = RrhhUnidad::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/rrhh_unidads/'.$rrhhUnidad->id,
            $editedRrhhUnidad
        );

        $this->assertApiResponse($editedRrhhUnidad);
    }

    /**
     * @test
     */
    public function test_delete_rrhh_unidad()
    {
        $rrhhUnidad = RrhhUnidad::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/rrhh_unidads/'.$rrhhUnidad->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/rrhh_unidads/'.$rrhhUnidad->id
        );

        $this->response->assertStatus(404);
    }
}
