<?php

namespace App\GraphQL\Query;

use App\Models\Product;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class ProductsQuery extends Query
{
    protected $attributes = [
        'name' => 'Products query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('productType'));
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ],
            'brand' => [
                'name' => 'brand',
                'type' => Type::string()
            ]            
        ];
    }

    public function resolve($root, $args)
    {
        $product = new Product();
        
        foreach ($args as $arg => $value) {
            $product = $product->where($arg, 'like',  '%'.$value.'%');
        }
        return $product->get();        
    }
}