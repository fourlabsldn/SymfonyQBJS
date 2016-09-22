<?php

namespace FL\QBJSParserBundle\Service;

use AppBundle\Entity\Product;
use FL\QBJSParser\Parser\Doctrine\DoctrineParser;

class QBJSDoctrineParserService
{
    private $classesAndMappings;

    /**
     * @param array $classesAndMappings
     */
    public function __construct(array $classesAndMappings)
    {
    }

    function newQBJSDoctrineParser(string $className){
        switch($className){
            case Product::class:
                return new DoctrineParser($className, ['id'=>'id', 'price'=>'price']);
                break;
            default:
                return new DoctrineParser($className);
        }
    }
}