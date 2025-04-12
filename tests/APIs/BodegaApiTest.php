<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Bodega;

class BodegaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_bodega()
    {
        $bodega = Bodega::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/bodegas', $bodega
        );

        $this->assertApiResponse($bodega);
    }

    /**
     * @test
     */
    public function test_read_bodega()
    {
        $bodega = Bodega::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/bodegas/'.$bodega->id
        );

        $this->assertApiResponse($bodega->toArray());
    }

    /**
     * @test
     */
    public function test_update_bodega()
    {
        $bodega = Bodega::factory()->create();
        $editedBodega = Bodega::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/bodegas/'.$bodega->id,
            $editedBodega
        );

        $this->assertApiResponse($editedBodega);
    }

    /**
     * @test
     */
    public function test_delete_bodega()
    {
        $bodega = Bodega::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/bodegas/'.$bodega->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/bodegas/'.$bodega->id
        );

        $this->response->assertStatus(404);
    }
}
