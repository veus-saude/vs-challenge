<?php

namespace Model\Brand;

class BrandRepository implements BrandRepositoryInterface
{
    public function get($brand_id)
    {
        return Brand::findOrFail($post_id);
    }
    public function all()
    {
        return Brand::all();
    }
    public function delete($brand_id)
    {
        return Brand::destroy($brand_id);
    }
    public function update($brand_id, array $brand_data)
    {
        $post = Brand::findOrFail($brand_id);
        $post->update($brand_data);
        return $post;
    }
}
