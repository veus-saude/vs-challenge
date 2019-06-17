<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductInputType extends GraphQLType
{
    protected $inputObject = true;    
    protected $attributes = [];

    public function __construct($attributes = [])
    {
        $this->attributes = [
            'name' => 'ProductInputType',
            'description' => ''
        ];
        parent::__construct($attributes);
    }

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'id'                
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'format yyyy-mm-dd'
            ],
            'brand' => [
                'type' => Type::string(),
                'description' => 'format yyyy-mm-dd'
            ]
        ];
    }
}
