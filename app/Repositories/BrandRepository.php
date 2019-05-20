<?php
namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Contracts\RepositoryInterface;

/**
 * Class BrandRepository
 * @package namespace App\Repositories;
 */
class BrandRepository extends Repository implements RepositoryInterface
{
    function model()
    {
        return Brand::class;
    }
}
