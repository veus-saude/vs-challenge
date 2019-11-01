<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $names = ['seringa', 'antitérmico', 'analgésico', 'pomada para queimaduras'];
        $brands = ['Negócio em cápsula','EMS Corp','Hypermarcas','Sanofi','Novartis','Aché','Eurofarma','Takeda'];

        for ($i= 0; $i < 30; $i++) {
            $product = new Product();

            $key = array_rand($names);            
            $product->setName($names[$key]);
            $key = array_rand($brands);     
            $product->setBrand($brands[$key]);
            $product->setPrice( strval(mt_rand(1*10,100*10) /10));
            $product->setAmount(rand(1,100));
            $manager->persist($product);
        }
        
        $manager->flush();
        $manager->flush();
    }   
}
