<?php

namespace App\Services;

use App\Repositories\BrandRepository;

class BrandService
{
    /**
     * @var BrandRepository
     */
    private $repository;

    /**
     * CidadeService constructor.
     */
    public function __construct(BrandRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

}