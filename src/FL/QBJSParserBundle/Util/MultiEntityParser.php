<?php

namespace FL\QBJSParserBundle\Util;

use FL\QBJSParser\Parser\Doctrine\AbstractDoctrineParser;


class MultiEntityParser extends AbstractDoctrineParser
{
    public function __construct(string $className, array $queryBuilderFieldsToEntityProperties)
    {
        parent::__construct($className, $queryBuilderFieldsToEntityProperties);
    }

}