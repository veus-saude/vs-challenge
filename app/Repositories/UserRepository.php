<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\RepositoryInterface;

/**
 * Class UserRepository
 * @package namespace App\Repositories;
 */
class UserRepository extends Repository implements RepositoryInterface
{
    function model()
    {
        return User::class;
    }
}
