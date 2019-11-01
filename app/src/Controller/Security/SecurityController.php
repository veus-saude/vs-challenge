<?php

namespace App\Controller\Security;

use App\Entity\User;
use Firebase\JWT\JWT;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Helper\ValidatorHelper;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\View\View;

class SecurityController extends AbstractFOSRestController
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @var ValidatorHelper
     */
    protected $validatorHelper;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct
    (
        EntityManagerInterface $entityManager,
        UserRepository $repository,
        UserPasswordEncoderInterface $encoder,
        ValidatorHelper $validatorHelper
    )
    {
        $this->repository = $repository;
        $this->encoder = $encoder;
        $this->validatorHelper = $validatorHelper;
        $this->entityManager  =$entityManager;
    }

    public function login(Request $request)
    {
        $jsonData = json_decode($request->getContent());
        if (empty($jsonData->username) || empty($jsonData->password)) {
            return new JsonResponse([
                'error' => 'Please send username and password'
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = $this->repository->findOneBy([
            'username' => $jsonData->username
        ]);

        if (empty($user) || !$this->encoder->isPasswordValid($user, $jsonData->password)) {
            return  new JsonResponse([
                'error' => 'username or password is invalid'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = JWT::encode(['username' => $user->getUsername()], getenv('APP_SECRET'), 'HS256');

        return new JsonResponse([
            'access_token' => $token
        ]);
    }


    public function register(Request $request)
    {
        $jsonData = json_decode($request->getContent());

        $user = new User();
        if(!empty($jsonData->username))
            $user->setUsername($jsonData->username);
        if(!empty($jsonData->password))    
            $user->setPassword($jsonData->password);

        $errorsResponse = $this->validatorHelper->validate($user);
        if (count($errorsResponse) > 0) {
            return  new View([
                'errors' => $errorsResponse
            ], Response::HTTP_BAD_REQUEST);
        }

        $userExist = $this->repository->findOneBy([
            'username' => $jsonData->username
        ]);

        if (!empty($userExist)) {
            return  new JsonResponse([
                'error' => 'Username is already in use'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $encoded = $this->encoder->encodePassword($user, $jsonData->password);
        $user->setPassword($encoded);

        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();

        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return new View($user, Response::HTTP_CREATED);
    }
}
