<?php

namespace App\Controller\Rest;

use App\Helper\PaginationHelper;
use App\Helper\ResponseHelper;
use App\Repository\RepositoryInterface;
use App\Service\EntityServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ValidatorHelper;

abstract class BaseController extends AbstractFOSRestController
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;
    /**
     * @var RepositoryInterface
     */
    protected $repository;
    /**
     * @var EntityServiceInterface
     */
    protected $service;
    /**
     * @var PaginationHelper
     */
    protected $paginationHelper;

    /**
     * @var ValidatorHelper
     */
    protected $validatorHelper;

    public function __construct(
        EntityManagerInterface $entityManager,
        RepositoryInterface $repository,
        EntityServiceInterface $service,
        PaginationHelper $paginationHelper,
        ValidatorHelper $validatorHelper
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->service = $service;
        $this->paginationHelper = $paginationHelper;
        $this->validatorHelper = $validatorHelper;
    }

    public function create(Request $request): View
    {
        try {

            $body = $request->getContent();
 
            $entity = $this->service->create($body);
            $errorsResponse = $this->validatorHelper->validate($entity);
            if (count($errorsResponse) > 0) {
                return  new View([
                    'errors' => $errorsResponse
                ], Response::HTTP_BAD_REQUEST);
            }

            $this->entityManager->persist($entity);
            $this->entityManager->flush();

        } catch (\InvalidArgumentException $ex) {
            return  new View([
                'error' => $ex->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return new View($entity, Response::HTTP_CREATED);
    }

    public function list(Request $request)
    {
        $queryString = $this->paginationHelper->getQueryString($request);
        $filter = $this->paginationHelper->getFilter($request);
        $ordenationFilter = $this->paginationHelper->getOrdenation($request);
        [$page, $size] = $this->paginationHelper->getPagination($request);

        try {
            $list = $this->repository->criteriaPagination(
                $queryString,
                $filter,
                $ordenationFilter,
                ($page - 1) * $size,
                $size
            );

        } catch (ORMException $ex) {
            return  new View([
                'error' => 'invalid request'
            ], Response::HTTP_BAD_REQUEST);
        }

        $responseFactory = new ResponseHelper(
            $list,
            Response::HTTP_PARTIAL_CONTENT,
            $page,
            $size
        );
        return $responseFactory->getResponse();
    }

    public function show(int $id): View
    {
        $entity = $this->repository->find($id);
        $statusCode = is_null($entity)
            ? Response::HTTP_NO_CONTENT
            : Response::HTTP_OK;
        $responseFactory = new ResponseHelper(
            $entity,
            $statusCode
        );

        return $responseFactory->getResponse();
    }

    public function delete(int $id): View
    {
        try {
            $entity = $this->repository->find($id);

            if(empty($entity)){
                return new View("Entity not found", Response::HTTP_BAD_REQUEST);        
            }


            $this->entityManager->remove($entity);
            $this->entityManager->flush();
        } catch (ORMException | ORMInvalidArgumentException $ex) {
            return  new View([
                'error' => 'invalid request'
            ], Response::HTTP_BAD_REQUEST);
        }

        return new View('', Response::HTTP_NO_CONTENT);
    }

    public function update(int $id, Request $request): View
    {
        $data = $request->getContent();
        try {
            $entityUpdate = $this->updateEntity($id, $data);

            $errorsResponse = $this->validatorHelper->validate($entityUpdate);
            if (count($errorsResponse) > 0) {
                return  new View([
                    'errors' => $errorsResponse
                ], Response::HTTP_BAD_REQUEST);
            }
            $this->entityManager->flush();

            $responseHelper = new ResponseHelper(
                $entityUpdate,
                Response::HTTP_OK
            );

            return $responseHelper->getResponse();
        } catch (\InvalidArgumentException $ex) {
            $responseHelper = new ResponseHelper(
                'Resource not found',
                Response::HTTP_NOT_FOUND
            );
            return $responseHelper->getResponse();
        }
    }

    abstract function updateEntity(int $id, String $json);
}
