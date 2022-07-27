<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Divisa;

class DivisaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_divisa()
    {
        $divisa = Divisa::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/divisas', $divisa
        );

        $this->assertApiResponse($divisa);
    }

    /**
     * @test
     */
    public function test_read_divisa()
    {
        $divisa = Divisa::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/divisas/'.$divisa->id
        );

        $this->assertApiResponse($divisa->toArray());
    }

    /**
     * @test
     */
    public function test_update_divisa()
    {
        $divisa = Divisa::factory()->create();
        $editedDivisa = Divisa::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/divisas/'.$divisa->id,
            $editedDivisa
        );

        $this->assertApiResponse($editedDivisa);
    }

    /**
     * @test
     */
    public function test_delete_divisa()
    {
        $divisa = Divisa::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/divisas/'.$divisa->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/divisas/'.$divisa->id
        );

        $this->response->assertStatus(404);
    }
}
