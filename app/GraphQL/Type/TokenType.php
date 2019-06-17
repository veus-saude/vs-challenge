<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TokenType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Token',
        'description' => 'A Token type'
    ];

    public function fields()
    {
        return [
            'token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The generated token',
            ],
        ];
    }
}
