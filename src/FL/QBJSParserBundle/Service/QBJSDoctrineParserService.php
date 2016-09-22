<?php

namespace FL\QBJSParserBundle\Service;

use FL\QBJSParser\Parser\Doctrine\DoctrineParser;

class QBJSDoctrineParserService
{
    /**
     * @var array
     * Class Name is the $className argument used when constructing @see DoctrineParser
     * Mapping is the $queryBuilderFieldsToEntityProperties when constructing @see DoctrineParser
     */
    private $classNameToMapping;

    /**
     * @var DoctrineParser[]
     */
    private $classNameToDoctrineParser;

    /**
     * @param array $classesAndMappings
     */
    public function __construct(array $classesAndMappings)
    {
        foreach($classesAndMappings as $classAndMappings){
            foreach($classAndMappings['mappings'] as $mapping){
                $this->classNameToMapping[$classAndMappings['class']][$mapping['query_builder_id']] = $mapping['entity_property'];
            }
        }
        foreach($this->classNameToMapping as $className => $queryBuilderFieldsToEntityProperties){
            $this->classNameToDoctrineParser[$className] = new DoctrineParser($className, $queryBuilderFieldsToEntityProperties);
        }
    }

    /**
     * @param string $className
     * @return DoctrineParser
     * @throws \DomainException
     */
    function newQBJSDoctrineParser(string $className){
        if(!array_key_exists($className, $this->classNameToDoctrineParser)){
            throw new \DomainException(sprintf(
                'You have requested a Doctrine Parser for %s, but you have not defined a mapping for it in your configuration',
                $className
            ));
        }
        return $this->classNameToDoctrineParser[$className];
    }
}