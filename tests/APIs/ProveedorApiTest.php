<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Proveedor;

class ProveedorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_proveedor()
    {
        $proveedor = Proveedor::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/proveedors', $proveedor
        );

        $this->assertApiResponse($proveedor);
    }

    /**
     * @test
     */
    public function test_read_proveedor()
    {
        $proveedor = Proveedor::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/proveedors/'.$proveedor->id
        );

        $this->assertApiResponse($proveedor->toArray());
    }

    /**
     * @test
     */
    public function test_update_proveedor()
    {
        $proveedor = Proveedor::factory()->create();
        $editedProveedor = Proveedor::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/proveedors/'.$proveedor->id,
            $editedProveedor
        );

        $this->assertApiResponse($editedProveedor);
    }

    /**
     * @test
     */
    public function test_delete_proveedor()
    {
        $proveedor = Proveedor::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/proveedors/'.$proveedor->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/proveedors/'.$proveedor->id
        );

        $this->response->assertStatus(404);
    }
}
