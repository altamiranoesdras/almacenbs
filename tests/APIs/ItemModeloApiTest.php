<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ItemModelo;

class ItemModeloApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_item_modelo()
    {
        $itemModelo = ItemModelo::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/item_modelos', $itemModelo
        );

        $this->assertApiResponse($itemModelo);
    }

    /**
     * @test
     */
    public function test_read_item_modelo()
    {
        $itemModelo = ItemModelo::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/item_modelos/'.$itemModelo->id
        );

        $this->assertApiResponse($itemModelo->toArray());
    }

    /**
     * @test
     */
    public function test_update_item_modelo()
    {
        $itemModelo = ItemModelo::factory()->create();
        $editedItemModelo = ItemModelo::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/item_modelos/'.$itemModelo->id,
            $editedItemModelo
        );

        $this->assertApiResponse($editedItemModelo);
    }

    /**
     * @test
     */
    public function test_delete_item_modelo()
    {
        $itemModelo = ItemModelo::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/item_modelos/'.$itemModelo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/item_modelos/'.$itemModelo->id
        );

        $this->response->assertStatus(404);
    }
}
