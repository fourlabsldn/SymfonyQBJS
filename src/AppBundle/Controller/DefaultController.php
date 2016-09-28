<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method(methods={"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $jsonString = <<<EOF
{
  "condition": "AND",
  "rules": [
    {
      "id": "price",
      "field": "price",
      "type": "double",
      "input": "text",
      "operator": "is_not_null",
      "value": null
    },
    {
      "id": "specification.description",
      "field": "specification.description",
      "type": "string",
      "input": "text",
      "operator": "equal",
      "value": "Product specification is a specification"
    },
    {
      "id": "labels.specification.description",
      "field": "labels.specification.description",
      "type": "string",
      "input": "text",
      "operator": "equal",
      "value": "Label specification is a specification"
    },
    {
      "condition": "OR",
      "rules": [
        {
          "id": "price",
          "field": "price",
          "type": "double",
          "input": "select",
          "operator": "greater",
          "value": "2.03"
        },
        {
          "id": "price",
          "field": "price",
          "type": "double",
          "input": "select",
          "operator": "less",
          "value": "2.03"
        }
      ]
    }
  ]
}
EOF;
        $jsonString = <<<EOF
{
  "condition": "AND",
  "rules": [
    {
      "id": "specification.description",
      "field": "specification.description",
      "type": "string",
      "input": "text",
      "operator": "not_equal",
      "value": "hello"
    }
  ]
}
EOF;


//        $parsedRuleGroup = $this->get('qbjs_parser.doctrine_parser')->parseJsonString($jsonString, Product::class);
//        dump($parsedRuleGroup);
//
//        $query = $this->get('doctrine.orm.entity_manager')->createQuery($parsedRuleGroup->getDqlString());
//        $query->setParameters($parsedRuleGroup->getParameters());
//        $results = $query->execute();
//
//        dump($results);

        $parserQueries = $this->get('qbjs_parser.parser_query')->getParserQueries();



        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'parser_queries' => $parserQueries,
        ]);
    }
}
