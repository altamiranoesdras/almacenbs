<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Equivalencia;

class EquivalenciaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_equivalencia()
    {
        $equivalencia = Equivalencia::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/equivalencias', $equivalencia
        );

        $this->assertApiResponse($equivalencia);
    }

    /**
     * @test
     */
    public function test_read_equivalencia()
    {
        $equivalencia = Equivalencia::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/equivalencias/'.$equivalencia->id
        );

        $this->assertApiResponse($equivalencia->toArray());
    }

    /**
     * @test
     */
    public function test_update_equivalencia()
    {
        $equivalencia = Equivalencia::factory()->create();
        $editedEquivalencia = Equivalencia::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/equivalencias/'.$equivalencia->id,
            $editedEquivalencia
        );

        $this->assertApiResponse($editedEquivalencia);
    }

    /**
     * @test
     */
    public function test_delete_equivalencia()
    {
        $equivalencia = Equivalencia::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/equivalencias/'.$equivalencia->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/equivalencias/'.$equivalencia->id
        );

        $this->response->assertStatus(404);
    }
}
