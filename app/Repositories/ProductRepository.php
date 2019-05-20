<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Support\Arr;

/**
 * Class ProductRepository
 * @package namespace App\Repositories;
 */
class ProductRepository extends Repository implements RepositoryInterface
{

    public function search(array $data)
    {
        $query = $this->model->newQuery();

        $query->leftJoin('brands','brands.id','=','products.brand_id');

        $search = Arr::get($data,'q');

        if ($search) {
            $query->where(function($query) use ($search){
                $query->where('products.name','LIKE',"%$search%")
                    ->orWhere('products.value','LIKE',"%$search%")
                    ->orWhere('brands.name','LIKE',"%$search%");
            });
        }

        $filter = Arr::get($data, 'filter');

        if ($filter) {
            $first_explode = explode(',',$filter);
            foreach ($first_explode as $first) {
                $second_explode = explode(':', $first);

                switch ($second_explode[0]) {
                    case 'name':
                        $query->where('products.name','LIKE',"%$second_explode[1]%");
                    break;

                    case 'brand':
                        $query->where('brands.name','LIKE',"%$second_explode[1]%");
                    break;

                    case 'value':
                        $query->where('products.value','LIKE',"%$second_explode[1]%");
                    break;
                }
            }
        }

        $query->select(
                'products.id',
                'products.name',
                'products.value',
                'products.quantity',
                'products.brand_id',
                'brands.name as brand_name');

        $order_by = Arr::get($data, 'orderBy');
        $sorted_by = Arr::get($data, 'sortedBy', 'desc');

        switch ($order_by) {
            case 'product':
                $query->orderBy('products.name', $sorted_by);
            break;

            case 'brand':
                $query->orderBy('brands.name', $sorted_by);
            break;

            case 'value':
                $query->orderBy('products.value', $sorted_by);
            break;

            default:
                $query->orderBy('products.name', 'desc');
            break;
        }

        return $query->paginate();
    }

    function model()
    {
        return Product::class;
    }
}
