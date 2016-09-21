<?php

namespace AppBundle\Service\Parser;

use AppBundle\Entity\Product;
use FL\QBJSParser\Parser\Doctrine\AbstractDoctrineParser;

class ProductParser extends AbstractDoctrineParser
{
    public function __construct()
    {
        parent::__construct(Product::class);
    }

    /**
     * @return array
     */
    protected function map_QueryBuilderFields_ToEntityProperties() : array
    {
        return [
            'id' => 'id',
            'price' => 'price',
        ];
    }
}
