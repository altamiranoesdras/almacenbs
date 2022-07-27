<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Unimed;

class UnimedApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_unimed()
    {
        $unimed = Unimed::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/unimeds', $unimed
        );

        $this->assertApiResponse($unimed);
    }

    /**
     * @test
     */
    public function test_read_unimed()
    {
        $unimed = Unimed::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/unimeds/'.$unimed->id
        );

        $this->assertApiResponse($unimed->toArray());
    }

    /**
     * @test
     */
    public function test_update_unimed()
    {
        $unimed = Unimed::factory()->create();
        $editedUnimed = Unimed::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/unimeds/'.$unimed->id,
            $editedUnimed
        );

        $this->assertApiResponse($editedUnimed);
    }

    /**
     * @test
     */
    public function test_delete_unimed()
    {
        $unimed = Unimed::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/unimeds/'.$unimed->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/unimeds/'.$unimed->id
        );

        $this->response->assertStatus(404);
    }
}
