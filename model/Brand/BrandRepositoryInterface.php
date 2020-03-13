<?php

namespace Model\Brand;

interface BrandRepositoryInterface
{
    public function get($brand_id);
    public function all();
    public function delete($brand_id);
    public function update($brand_id, array $brand_data);
}
