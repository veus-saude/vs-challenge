<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductService implements EntityServiceInterface
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ProductRepository $productRepository,ValidatorInterface $validator)
    {
        $this->productRepository = $productRepository;
        $this->validator = $validator;
    }

    public function create(String $json) : Product
    {
        $jsonData = json_decode($json);

        if(empty($jsonData))
            throw new \InvalidArgumentException("Invalid Request", Response::HTTP_BAD_REQUEST);        

        $product = new Product();
        if(!empty($jsonData->name))
            $product->setName($jsonData->name);
        if(!empty($jsonData->brand))
            $product->setBrand($jsonData->brand);
        if(!empty($jsonData->price))
            $product->setPrice($jsonData->price);
        if(!empty($jsonData->price))
            $product->setAmount($jsonData->amount);

        return $product;
    }
}
