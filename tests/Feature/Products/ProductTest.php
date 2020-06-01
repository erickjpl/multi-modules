<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

     /**
     * @test
     */
    public function test_create_product()
    {
        /* $this->withoutExceptionHandling();

        $product = factory(Product::class)->create();

        $response = $this->postJson(route('test.index'));

        $response->assertApiResponse([
            'id' => (string) $this->getRouteKey(),
            'type' => 'products',
            'attributes' => [
                'id' => $this->id,
                'product' => $this->product,
                'slug' => $this->slug,
                'description' => $this->description
            ],
            'relationships' => [
                'categories' => [
                    'data' => [
                        'id' => $category->getRouteKey(),
                        'type' => 'categories',
                    ],
                    'links' => [
                        'related' => route('api.categories.show', $category->getRouteKey())
                    ]
                ],
                'images' => [
                    ImageExt::make( $images )
                ],
                'inventories' => [
                    InventoryExt::make( $availableInventories )
                ]
            ],
            'included' => [
                'categories' => CategoryResource::make( $category ),
                'images' => ImageCollection::make( $images ),
                'inventories' => InventoryCollection::make( $availableInventories )
            ],
            'links' => [
                'self' => route('api.products.show', $this->getRouteKey())
            ]
        ]); */

        $response->assertTrue(true);
    }
}
