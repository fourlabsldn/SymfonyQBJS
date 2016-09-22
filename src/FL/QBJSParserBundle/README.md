#QBJSParserBundle

### Installation

- Install with composer.
- Add the Bundle to app/AppKernel.php

```php
<?php

    //...
    $bundles = [
        //...
        new FL\QBJSParserBundle\QBJSParserBundle(),
    ];
```
- Set up configuration, as detailed below.

### Configuration Example

```yml
qbjs_parser:
    doctrine_classes_and_mappings: # only if you will be using the service "qbjs_parser.doctrine_parser"
        app_entity_product: # this key is for organizational purposes only
            class: AppBundle\Entity\Product # Class Name of a Doctrine Entity
            mappings: # required
                product_id: 
                    query_builder_id: id 
                    entity_property: id 
                product_price: # this key is for organizational purposes only
                    query_builder_id: price # Coming from a jsonString sent by QueryBuilderJS
                    entity_property: price # A visible property (public or by getter) in your entity
```

### Usage Example

```php
<?php
    namespace App\Controller;
    
    //...
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use AppBundle\Entity\Product;

    class ProductController extends Controller
    {
        public function reportsAction(Request $request, string $jsonString)
        {
             $parsedRuleGroup = $this->get('qbjs_parser.doctrine_parser')->parseJsonString($jsonString, Product::class);
             
             $query = $this->get('doctrine.orm.entity_manager')->createQuery($parsedRuleGroup->getDqlString());
             $query->setParameters($parsedRuleGroup->getParameters());
             $results = $query->execute();
             
             //...
        }
    }
    

```