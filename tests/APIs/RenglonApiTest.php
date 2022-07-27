<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Renglon;

class RenglonApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_renglon()
    {
        $renglon = Renglon::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/renglons', $renglon
        );

        $this->assertApiResponse($renglon);
    }

    /**
     * @test
     */
    public function test_read_renglon()
    {
        $renglon = Renglon::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/renglons/'.$renglon->id
        );

        $this->assertApiResponse($renglon->toArray());
    }

    /**
     * @test
     */
    public function test_update_renglon()
    {
        $renglon = Renglon::factory()->create();
        $editedRenglon = Renglon::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/renglons/'.$renglon->id,
            $editedRenglon
        );

        $this->assertApiResponse($editedRenglon);
    }

    /**
     * @test
     */
    public function test_delete_renglon()
    {
        $renglon = Renglon::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/renglons/'.$renglon->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/renglons/'.$renglon->id
        );

        $this->response->assertStatus(404);
    }
}
