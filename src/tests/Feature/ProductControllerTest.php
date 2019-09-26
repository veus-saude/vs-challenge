<?php

namespace Tests\Feature;

use App\User;
use App\Brand;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductControllerTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function can_create_product()
    {

        // given
            // user is authenticated
            $user = factory(User::class)->make();

        // when

            $data = [
                'name'      => 'Skywalker',
                'brand_id'  => factory(Brand::class)->create()->id,
                'price'     => $this->faker->randomFloat(2),
                'quantity'  => $this->faker->randomNumber
            ];

            // post request
            $response = $this->actingAs($user, 'api')->json('POST', 'api/v2/products', $data);

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

            // product exists
            $product = factory(Product::class)->create();

        // when
            // get request
            $response = $this->actingAs($user, 'api')->json('GET', 'api/v2/products/' . $product->id);

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

            // product exists
            $product = factory(Product::class)->create();

        // when
            $data = [
                'name'      => 'Skywalker',
                'brand_id'  => factory(Brand::class)->create()->id,
                'price'     => $this->faker->randomFloat(2),
                'quantity'  => $this->faker->randomNumber
            ];

            // put request
            $response = $this->actingAs($user, 'api')->json('PUT', 'api/v2/products/' . $product->id, $data);

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

            // product exists
            $product = factory(Product::class)->create();

        // when
            // delete request
            $deleteresponse = $this->actingAs($user, 'api')->json('DELETE', 'api/v2/products/' . $product->id);

            // get product
            $productresponse = $this->actingAs($user, 'api')->json('GET', 'api/v2/products/' . $product->id);

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
