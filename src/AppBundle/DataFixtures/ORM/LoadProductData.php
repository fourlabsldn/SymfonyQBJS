<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Product;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProductData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $products = [
          ['name' => 'Chair', 'price' => 12.00],
          ['name' => 'Table', 'price' => "22.00"],
          ['name' => 'Water', 'price' => 2.50],
          ['name' => 'Life', 'price' => null],
        ];
        foreach ($products as $product) {
            $productObject = new Product();
            $productObject->setName($product['name']);
            $productObject->setPrice($product['price']);
            $manager->persist($productObject);
        }

        $manager->flush();
    }
}
