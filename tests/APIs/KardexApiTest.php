<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Kardex;

class KardexApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_kardex()
    {
        $kardex = Kardex::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/kardexes', $kardex
        );

        $this->assertApiResponse($kardex);
    }

    /**
     * @test
     */
    public function test_read_kardex()
    {
        $kardex = Kardex::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/kardexes/'.$kardex->id
        );

        $this->assertApiResponse($kardex->toArray());
    }

    /**
     * @test
     */
    public function test_update_kardex()
    {
        $kardex = Kardex::factory()->create();
        $editedKardex = Kardex::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/kardexes/'.$kardex->id,
            $editedKardex
        );

        $this->assertApiResponse($editedKardex);
    }

    /**
     * @test
     */
    public function test_delete_kardex()
    {
        $kardex = Kardex::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/kardexes/'.$kardex->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/kardexes/'.$kardex->id
        );

        $this->response->assertStatus(404);
    }
}
