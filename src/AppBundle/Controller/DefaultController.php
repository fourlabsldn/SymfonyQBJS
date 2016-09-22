<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
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
      "id": "price",
      "field": "price",
      "type": "double",
      "input": "text",
      "operator": "is_not_null",
      "value": null
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
        $parsedRuleGroup = $this->get('qbjs_parser.doctrine_parser')->parseJsonString($jsonString, Product::class);

        $query = $this->get('doctrine.orm.entity_manager')->createQuery($parsedRuleGroup->getDqlString());
        $query->setParameters($parsedRuleGroup->getParameters());
        $results = $query->execute();

//        dump($parsedRuleGroup);
//        dump($results);

        $dqlString1 = 'SELECT object FROM AppBundle\Entity\Product object JOIN AppBundle\Entity\Label label WHERE ( label.id IS NOT NULL )';
        $dqlString2 = 'SELECT object, label, specification FROM AppBundle\Entity\Product object JOIN object.labels label  JOIN label.specification specification WHERE ( object.specification IS NOT NULL )';
        $results = $this->get('doctrine.orm.entity_manager')->createQuery($dqlString2)->execute();
        foreach($results as $result){
            /** @var Product $result */
            $result->getLabels();
            $result->getSpecification();
            dump($result);
        }


        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}
