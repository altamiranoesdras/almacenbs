<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ItemCategoria;

class ItemCategoriaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_item_categoria()
    {
        $itemCategoria = ItemCategoria::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/item_categorias', $itemCategoria
        );

        $this->assertApiResponse($itemCategoria);
    }

    /**
     * @test
     */
    public function test_read_item_categoria()
    {
        $itemCategoria = ItemCategoria::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/item_categorias/'.$itemCategoria->id
        );

        $this->assertApiResponse($itemCategoria->toArray());
    }

    /**
     * @test
     */
    public function test_update_item_categoria()
    {
        $itemCategoria = ItemCategoria::factory()->create();
        $editedItemCategoria = ItemCategoria::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/item_categorias/'.$itemCategoria->id,
            $editedItemCategoria
        );

        $this->assertApiResponse($editedItemCategoria);
    }

    /**
     * @test
     */
    public function test_delete_item_categoria()
    {
        $itemCategoria = ItemCategoria::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/item_categorias/'.$itemCategoria->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/item_categorias/'.$itemCategoria->id
        );

        $this->response->assertStatus(404);
    }
}
