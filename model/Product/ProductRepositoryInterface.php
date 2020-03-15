<?php

namespace Model\Product;

interface ProductRepositoryInterface
{
    public function get($product_id);
    public function all();
    public function delete($product_id);
    public function update($product_id, array $product_data);
    public function create(array $product_data);
}
