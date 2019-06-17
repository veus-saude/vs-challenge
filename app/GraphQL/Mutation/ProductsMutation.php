<?php
namespace App\GraphQL\Mutation;

use GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Models\Product;

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
        return [
            'product' => [
                'name' => 'product',
                'type' => GraphQL::type('productInput'),
                'description' => 'product'
            ]
        ];
    }

    /**
     * @SuppressWarnings("unused")
     */
    public function resolve($root, $args)
    {
        if (!isset($args['product']['id'])) {
            $product = Product::create($args['product']);
            return $product;
        }

        $product = Product::findOrFail($args['product']['id']);
        $product->update($args['product']);
        
        return $product;
    }
}
