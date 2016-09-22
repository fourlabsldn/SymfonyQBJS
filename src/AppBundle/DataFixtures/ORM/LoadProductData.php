<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Label;
use AppBundle\Entity\Product;
use AppBundle\Entity\Specification;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProductData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $label = new Label();
        $label->setName('SALE');

        $specification = new Specification();
        $specification->setDescription('Table specification is a specification of specifications');

        $products = [
            'chair' => ['name' => 'Chair', 'price' => 12.00],
            'table' => ['name' => 'Table', 'price' => "22.00"],
            'water' => ['name' => 'Water', 'price' => 2.50],
            'life' => ['name' => 'Life', 'price' => null],
        ];
        foreach ($products as $key => $product) {
            $productObject = new Product();
            $productObject->setName($product['name']);
            $productObject->setPrice($product['price']);
            $productObject->addLabel($label);
            switch ($key){
                case 'table':
                    $productObject->setSpecification($specification);
            }
            $manager->persist($productObject);
        }

        $manager->flush();
    }
}
