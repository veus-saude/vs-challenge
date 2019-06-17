<?php
namespace App\GraphQL\Mutation;

use GraphQL;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use App\Models\Product;

class DeleteProductsMutation extends Mutation
{
    protected $attributes = [
        'name' => 'delete product',
        'description' => 'delete a product'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'description' => 'id'
            ]
        ];
    }

    /**
     * @SuppressWarnings("unused")
     */
    public function resolve($root, $args)
    {
        $product = Product::findOrFail($args['id']);
        $product->delete();
        return 'success';
    }
}
