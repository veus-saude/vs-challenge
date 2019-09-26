<?php

namespace Tests\Unit;

use App\Brand;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductControllerTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    /**
     * @test
     */
    public function can_create_product()
    {

        // given
            // user is authenticated
            $user = factory(User::class)->make();

        // when
            // post request
            $response = $this->actingAs($user, 'api')
                             ->json('POST', 'api/v2/products', [
                                'name' => 'Skywalker',
                                'brand_id' => factory(Brand::class)->make()->id,
                                'price' => $this->faker->randomFloat(2),
                                'quantity' => $this->faker->randomNumber
                            ]);

        // then
            // product must exist
            $response->assertOk();
    }

     /**
     * @test
     */
    public function can_show_product()
    {
        // given
            // user is authenticated
            $user = factory(User::class)->make();

        // when
            // get request
            $response = $this->actingAs($user, 'api')
                             ->json('PUT', 'api/v2/products/' . $product->id);

        // then
            // product must be returned
            $response->assertOk();
    }

    /**
     * @test
     */
    public function can_update_product()
    {
        // given
            // user is authenticated
            $user = factory(User::class)->make();

        // when
            // put request
            $product = factory(Product::class)->make();

            $response = $this->actingAs($user, 'api')
                            ->json('PUT', 'api/v2/products/' . $product->id, [
                                'name' => 'Skywalker',
                                'brand_id' => factory(Brand::class)->make()->id,
                                'price' => $this->faker->randomFloat(2),
                                'quantity' => $this->faker->randomNumber
                            ]);
        // then
            // product must be updated
            $response->assertOk();
    }

    /**
     * @test
     */
    public function can_delete_product()
    {
        // given
            // user is authenticated
            $user = factory(User::class)->make();

        // when
            // delete request
            $product = factory(Product::class)->make();

            $deleteresponse = $this->actingAs($user, 'api')
                                    ->json('DELETE', 'api/v2/products/' . $product->id);

            $productresponse = $this->actingAs($user, 'api')
                                    ->json('GET', 'api/v2/products/' . $product->id);

        // then
            // request must be OK
            $deleteresponse->assertOk();

            // product must be deleted
            $productresponse->assertNotFound();
    }

     /**
     * @test
     */
    public function can_do_some_crud()
    {
        // when
            // try get product
            $response = $this->get('api/v2/products');

        // then
            // should not have access
            $response->assertUnauthorized();
    }

    /**
     * @test
     */
    public function has_brand()
    {
        //given
            // product exists
            $product = factory(Product::class)->make();

        // when
            // get brand relationship
            $has_brand = $product->brand()->exists();

        // then
            // product must have a brand
            $this->assertTrue($has_brand);
    }
}
