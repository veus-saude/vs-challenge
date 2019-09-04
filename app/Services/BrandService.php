<?php
/**
 * Desenvolvido por: Lucas Maia - lucas.codemax@gmail.com
 * WhatsApp: (21) 96438-6937
 *
 * Criado em: 28/08/19 15:47
 * Projeto: Desafio Veus
 */

namespace App\Services;

use App\Models\Brand;
use App\Repositories\BrandRepository;

class BrandService
{
    /**
     * @var BrandRepository
     */
    private $brandRepository;

    /**
     * BrandService constructor.
     * @param BrandRepository $brandRepository
     */
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function create($params)
    {
        return $this->brandRepository->create($params);
    }

    public function update(Brand $brand, $params)
    {
        return $this->brandRepository->update($params, $brand->id);
    }

    public function delete(Brand $brand)
    {
        return $this->brandRepository->delete($brand->id);
    }

    public function all($order_by = '', $direction = 'ASC')
    {
        if(!empty($order_by)){
            return $this->brandRepository->orderBy($order_by, $direction)->paginate(20);
        }else{
            return $this->brandRepository->paginate(20);
        }
    }

    public function get($filters = array())
    {
        $brand = Brand::query();
        foreach ($filters as $field => $filter)
        {
            $brand->where([$field => $filter]);
        }
        $brand->get();

        if($brand->isNotEmpty())
        {
            return $brand->paginate();
        }

        return NULL;
    }
}