<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Compra1h;

class Compra1hApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_compra1h()
    {
        $compra1h = Compra1h::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/compra1hs', $compra1h
        );

        $this->assertApiResponse($compra1h);
    }

    /**
     * @test
     */
    public function test_read_compra1h()
    {
        $compra1h = Compra1h::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/compra1hs/'.$compra1h->id
        );

        $this->assertApiResponse($compra1h->toArray());
    }

    /**
     * @test
     */
    public function test_update_compra1h()
    {
        $compra1h = Compra1h::factory()->create();
        $editedCompra1h = Compra1h::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/compra1hs/'.$compra1h->id,
            $editedCompra1h
        );

        $this->assertApiResponse($editedCompra1h);
    }

    /**
     * @test
     */
    public function test_delete_compra1h()
    {
        $compra1h = Compra1h::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/compra1hs/'.$compra1h->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/compra1hs/'.$compra1h->id
        );

        $this->response->assertStatus(404);
    }
}
