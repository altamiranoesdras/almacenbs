<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Magnitud;

class MagnitudApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_magnitud()
    {
        $magnitud = Magnitud::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/magnitudes', $magnitud
        );

        $this->assertApiResponse($magnitud);
    }

    /**
     * @test
     */
    public function test_read_magnitud()
    {
        $magnitud = Magnitud::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/magnitudes/'.$magnitud->id
        );

        $this->assertApiResponse($magnitud->toArray());
    }

    /**
     * @test
     */
    public function test_update_magnitud()
    {
        $magnitud = Magnitud::factory()->create();
        $editedMagnitud = Magnitud::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/magnitudes/'.$magnitud->id,
            $editedMagnitud
        );

        $this->assertApiResponse($editedMagnitud);
    }

    /**
     * @test
     */
    public function test_delete_magnitud()
    {
        $magnitud = Magnitud::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/magnitudes/'.$magnitud->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/magnitudes/'.$magnitud->id
        );

        $this->response->assertStatus(404);
    }
}
