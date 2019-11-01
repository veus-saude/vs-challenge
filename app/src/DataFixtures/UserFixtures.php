<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('usuario')
            ->setPassword('$argon2i$v=19$m=1024,t=2,p=2$NG5mWHZBZWFxV1AxNDlqMA$D5yYbKVzQO4LuyCxtcyFkA5bFJtdnN0PeTzvPBudT+s');

        $manager->persist($user);
        $manager->flush();        
    }
}