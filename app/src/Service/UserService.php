<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserService implements EntityServiceInterface
{
    /**
     * @var UserRepository
     */
    private $UserRepository;
    
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(UserRepository $UserRepository,ValidatorInterface $validator)
    {
        $this->UserRepository = $UserRepository;
        $this->validator = $validator;
    }

    public function create(String $json) : User
    {
        $jsonData = json_decode($json);

        if(empty($jsonData))
            throw new \InvalidArgumentException("Invalid Request", Response::HTTP_BAD_REQUEST);        

        $User = new User();
        if(!empty($jsonData->name))
            $User->setName($jsonData->name);
        if(!empty($jsonData->brand))
            $User->setBrand($jsonData->brand);
        if(!empty($jsonData->price))
            $User->setPrice($jsonData->price);
        if(!empty($jsonData->price))
            $User->setAmount($jsonData->amount);

        return $User;
    }
}
