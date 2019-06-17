<?php
namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Log;

class ProductsMutation extends Mutation
{
    protected $attributes = [
        'name' => 'product',
        'description' => 'Create/update a product'
    ];

    public function type()
    {
        return GraphQL::type('productType');
    }

    public function args()
    {
        return GraphQL::type('productInput');
    }

    /**
     * @SuppressWarnings("unused")
     */
    public function resolve($root, $args)
    {
        print_r($args);
    }
}
