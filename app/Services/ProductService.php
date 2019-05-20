<?php

namespace App\Services;

use App\Exceptions\ValidatorException;
use App\Repositories\ProductRepository;
use App\Validators\ProductSearchValidator;

class ProductService
{
    /**
     * @var ProductRepository
     */
    private $repository;
    /**
     * @var ProductSearchValidator
     */
    private $validator;

    /**
     * CidadeService constructor.
     */
    public function __construct(ProductRepository $repository, ProductSearchValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function query(array $data)
    {
        if (!$this->validator->validate($data)) {
            throw new ValidatorException($this->validator->getErrors());
        }

        return $this->repository->search($data);
    }

    public function get()
    {
        return $this->repository->search();
    }

}