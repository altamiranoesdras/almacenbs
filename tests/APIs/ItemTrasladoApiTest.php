<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ItemTraslado;

class ItemTrasladoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_item_traslado()
    {
        $itemTraslado = ItemTraslado::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/item_traslados', $itemTraslado
        );

        $this->assertApiResponse($itemTraslado);
    }

    /**
     * @test
     */
    public function test_read_item_traslado()
    {
        $itemTraslado = ItemTraslado::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/item_traslados/'.$itemTraslado->id
        );

        $this->assertApiResponse($itemTraslado->toArray());
    }

    /**
     * @test
     */
    public function test_update_item_traslado()
    {
        $itemTraslado = ItemTraslado::factory()->create();
        $editedItemTraslado = ItemTraslado::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/item_traslados/'.$itemTraslado->id,
            $editedItemTraslado
        );

        $this->assertApiResponse($editedItemTraslado);
    }

    /**
     * @test
     */
    public function test_delete_item_traslado()
    {
        $itemTraslado = ItemTraslado::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/item_traslados/'.$itemTraslado->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/item_traslados/'.$itemTraslado->id
        );

        $this->response->assertStatus(404);
    }
}
