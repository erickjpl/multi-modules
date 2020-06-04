<?php namespace Tests\APIs;

use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Products\Product;
use App\Models\Products\Config\Category;
use App\Http\Resources\Config\ImageCollection;
use App\Http\Resources\Products\CategoryResource;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Http\Resources\Inventories\InventoryCollection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Resources\Relationships\Config\ImageCollection As ImageExt;
use App\Http\Resources\Relationships\Categories\CategoryResource As CategoryExt;
use App\Http\Resources\Relationships\Inventories\InventoryCollection As InventoryExt;

class ProductApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    # use RefreshDatabase;

     /**
     * @test
     */
    public function test_create_product()
    {
        $this->withoutExceptionHandling();

        factory(Category::class)->times(3)->create();
        $product = factory(Product::class)->create();

        $product->with(['category', 'images', 'inventories'])->get();

        $this->response = $this->getJson( route('test.show', $product->getRouteKey()) );

        $this->assertApiResponse([
            'id' => (string) $product->getRouteKey(),
            'type' => 'products',
            'attributes' => [
                'id' => $product->id,
                'product' => $product->product,
                'slug' => $product->slug,
                'description' => $product->description
            ],
            'relationships' => [
                'categories' => [
                    // CategoryExt::make( $product->category )
                ],
                'images' => [
                    // ImageExt::make( $product->images )
                ],
                'inventories' => [
                    // InventoryExt::make( $product->availableInventories )
                ]
            ],
            'included' => [
                // 'categories' => CategoryResource::make( $product->category ),
                // 'images' => ImageCollection::make( $product->images ),
                // 'inventories' => InventoryCollection::make( $product->availableInventories )
            ],
            'links' => [
                'self' => route('api.products.show', $product->getRouteKey())
            ]
        ]);
    }

    /**
     * @test
     */
    /* public function test_create_product()
    {
        $product = factory(Product::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/products/products', $product
        );

        $this->assertApiResponse($product);
    } */

    /**
     * @test
     */
   /*  public function test_read_product()
    {
        $product = factory(Product::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/products/products/'.$product->id
        );

        $this->assertApiResponse($product->toArray());
    } */

    /**
     * @test
     */
    /* public function test_update_product()
    {
        $product = factory(Product::class)->create();
        $editedProduct = factory(Product::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/products/products/'.$product->id,
            $editedProduct
        );

        $this->assertApiResponse($editedProduct);
    } */

    /**
     * @test
     */
    /* public function test_delete_product()
    {
        $product = factory(Product::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/products/products/'.$product->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/products/products/'.$product->id
        );

        $this->response->assertStatus(404);
    } */
}
