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
        $jsonString = '{"condition":"AND","rules":[{"id":"price","field":"price","type":"double","input":"text","operator":"is_not_null","value":null},{"condition":"OR","rules":[{"id":"price","field":"price","type":"double","input":"select","operator":"greater","value":"2.03"},{"id":"price","field":"price","type":"double","input":"select","operator":"less","value":"2.03"}]}]}';
        $parsedRuleGroup = $this->get('qbjs_parser.doctrine_parser')->parseJsonString($jsonString, Product::class);

        $query = $this->get('doctrine.orm.entity_manager')->createQuery($parsedRuleGroup->getDqlString());
        $query->setParameters($parsedRuleGroup->getParameters());
        $results = $query->execute();

        dump($parsedRuleGroup);
        dump($results);

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}
