<?php

namespace App\Controller\Rest;

use App\Entity\Product;
use FOS\RestBundle\View\View;
use App\Service\ProductService;
use App\Helper\PaginationHelper;
use App\Repository\ProductRepository;
use App\Controller\Rest\BaseController;
use App\Helper\ValidatorHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Rest\RouteResource("Product")
 */

class ProductController extends BaseController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        ProductService $productService,
        ProductRepository $productRepository,
        PaginationHelper $paginationHelper,
        ValidatorHelper $validatorHelper
    ) {
        parent::__construct($entityManager, $productRepository, $productService, $paginationHelper, $validatorHelper);
        $this->productRepository = $productRepository;
    }

    /**
     * @Rest\Get("/products")
     */
    public function list(Request $request){
        return parent::list($request);
    }

    /**
     * @Rest\Post("/products")
     */
    public function create(Request $request): View
    {
        return parent::create($request);
    }

    /**
     * @Rest\Get("/products/{id}")
     */
    public function show(int $id): View
    {
        return parent::show($id);
    }

    /**
    * @Rest\Delete("/products/{id}")
    */
    public function delete(int $id): View
    {
        return parent::delete($id);
    }

    /**
    * @Rest\Put("/products/{id}")
    */
    public function update(int $id, Request $request): View
    {
        return parent::update($id, $request);
    }

    public function updateEntity(int $id, $json)
    {

        /**
         * @var Product
         */
        $jsonData = json_decode($json);

        $product = $this->entityManager->getRepository(Product::class)->find($id);
        if (is_null($product)) {
            throw new \InvalidArgumentException('Entity not found');
        }

        if(!empty($jsonData->name))
            $product->setName($jsonData->name);
        if(!empty($jsonData->brand))
            $product->setBrand($jsonData->brand);
        if(!empty($jsonData->price))
            $product->setPrice($jsonData->price);
        if(!empty($jsonData->amount))
            $product->setAmount($jsonData->amount);

        return $product;
    }
}
