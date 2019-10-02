<?php

namespace App\Transformers;

use App\Product;
use League\Fractal;

class ProductTransformer extends Fractal\TransformerAbstract
{
    public function transform(Product $product)
    {
        return [
            'id'      => (int) $product->id,
            'name'   => $product->name,
            'description'    =>  $product->description,
            'sku'   => $product->sku,
            'brand'   => $product->brand,
            'created_at'    =>  $product->created_at->format('d-m-Y'),
            'updated_at'    =>  $product->updated_at->format('d-m-Y'),
            'links'   => [
                [
                    'uri' => 'products/' . $product->id,
                ]
            ],
        ];
    }
}
