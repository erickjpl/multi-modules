<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Products\Sales\Inventory;

class InventoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_inventory()
    {
        $inventory = factory(Inventory::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/products/sales/inventories', $inventory
        );

        $this->assertApiResponse($inventory);
    }

    /**
     * @test
     */
    public function test_read_inventory()
    {
        $inventory = factory(Inventory::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/products/sales/inventories/'.$inventory->id
        );

        $this->assertApiResponse($inventory->toArray());
    }

    /**
     * @test
     */
    public function test_update_inventory()
    {
        $inventory = factory(Inventory::class)->create();
        $editedInventory = factory(Inventory::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/products/sales/inventories/'.$inventory->id,
            $editedInventory
        );

        $this->assertApiResponse($editedInventory);
    }

    /**
     * @test
     */
    public function test_delete_inventory()
    {
        $inventory = factory(Inventory::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/products/sales/inventories/'.$inventory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/products/sales/inventories/'.$inventory->id
        );

        $this->response->assertStatus(404);
    }
}
