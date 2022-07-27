<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ItemTrasladoEstado;

class ItemTrasladoEstadoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_item_traslado_estado()
    {
        $itemTrasladoEstado = ItemTrasladoEstado::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/item_traslado_estados', $itemTrasladoEstado
        );

        $this->assertApiResponse($itemTrasladoEstado);
    }

    /**
     * @test
     */
    public function test_read_item_traslado_estado()
    {
        $itemTrasladoEstado = ItemTrasladoEstado::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/item_traslado_estados/'.$itemTrasladoEstado->id
        );

        $this->assertApiResponse($itemTrasladoEstado->toArray());
    }

    /**
     * @test
     */
    public function test_update_item_traslado_estado()
    {
        $itemTrasladoEstado = ItemTrasladoEstado::factory()->create();
        $editedItemTrasladoEstado = ItemTrasladoEstado::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/item_traslado_estados/'.$itemTrasladoEstado->id,
            $editedItemTrasladoEstado
        );

        $this->assertApiResponse($editedItemTrasladoEstado);
    }

    /**
     * @test
     */
    public function test_delete_item_traslado_estado()
    {
        $itemTrasladoEstado = ItemTrasladoEstado::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/item_traslado_estados/'.$itemTrasladoEstado->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/item_traslado_estados/'.$itemTrasladoEstado->id
        );

        $this->response->assertStatus(404);
    }
}
