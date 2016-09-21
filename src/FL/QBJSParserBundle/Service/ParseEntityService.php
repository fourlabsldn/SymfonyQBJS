<?php

namespace FL\QBJSParserBundle\Service;

use FL\QBJSParserBundle\Util\MultiEntityParser;

class ParseEntityService
{
    function parse(string $className, array $queryBuilderFieldsToEntityProperties){
        return new MultiEntityParser($className, $queryBuilderFieldsToEntityProperties);
    }
}