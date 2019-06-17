<?php

namespace App\GraphQL\Type;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductType extends GraphQLType
{    
    protected $attributes = [
        'name'          => 'ProductType',
        'description'   => 'A product',
        'model'         => Product::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'The id of the user',
                //'alias' => 'user_id', // Use 'alias', if the database column is different from the type name
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The email of user',
            ],
            // Uses the 'getIsMeAttribute' function on our custom User model
            'brand' => [
                'type' => Type::string(),
                'description' => 'True, if the queried user is the current user',
                //'selectable' => false, // Does not try to query this from the database
            ]
        ];
    }
}