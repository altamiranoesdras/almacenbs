<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CompraTipo;

class CompraTipoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_compra_tipo()
    {
        $compraTipo = CompraTipo::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/compra_tipos', $compraTipo
        );

        $this->assertApiResponse($compraTipo);
    }

    /**
     * @test
     */
    public function test_read_compra_tipo()
    {
        $compraTipo = CompraTipo::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/compra_tipos/'.$compraTipo->id
        );

        $this->assertApiResponse($compraTipo->toArray());
    }

    /**
     * @test
     */
    public function test_update_compra_tipo()
    {
        $compraTipo = CompraTipo::factory()->create();
        $editedCompraTipo = CompraTipo::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/compra_tipos/'.$compraTipo->id,
            $editedCompraTipo
        );

        $this->assertApiResponse($editedCompraTipo);
    }

    /**
     * @test
     */
    public function test_delete_compra_tipo()
    {
        $compraTipo = CompraTipo::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/compra_tipos/'.$compraTipo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/compra_tipos/'.$compraTipo->id
        );

        $this->response->assertStatus(404);
    }
}
