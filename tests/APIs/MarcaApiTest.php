<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Marca;

class MarcaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_marca()
    {
        $marca = Marca::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/marcas', $marca
        );

        $this->assertApiResponse($marca);
    }

    /**
     * @test
     */
    public function test_read_marca()
    {
        $marca = Marca::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/marcas/'.$marca->id
        );

        $this->assertApiResponse($marca->toArray());
    }

    /**
     * @test
     */
    public function test_update_marca()
    {
        $marca = Marca::factory()->create();
        $editedMarca = Marca::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/marcas/'.$marca->id,
            $editedMarca
        );

        $this->assertApiResponse($editedMarca);
    }

    /**
     * @test
     */
    public function test_delete_marca()
    {
        $marca = Marca::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/marcas/'.$marca->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/marcas/'.$marca->id
        );

        $this->response->assertStatus(404);
    }
}
