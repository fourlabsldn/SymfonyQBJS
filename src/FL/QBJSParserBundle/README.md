#QBJSParserBundle

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