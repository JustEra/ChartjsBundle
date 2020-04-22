<?php

namespace Aldaflux\ChartjsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

#use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ManagerRegistry;
use Aldaflux\ChartjsBundle\Model\ChartBuiderData;
use Aldaflux\ChartjsBundle\Utils\TypeCharjs;
use Aldaflux\ChartjsBundle\Utils\TypeColors;
use Aldaflux\ChartjsBundle\Model\ChartData;


class ChartjsController extends AbstractController
{
    
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    

    /**
     * @Route("/", name="testchart")
     * @Method("GET")
     */
    public function mainTestAction() {
        return $this->render('ChartjsBundle:test:mainTest.html.twig');
    }

    
    /**
     * @Route("/bar", name="chart_bar")
     * @Method("GET")
     */
    public function barAction()
    {

        $grafica = new ChartBuiderData();
        $grafica->setType(TypeCharjs::CHARJS_BAR);
        $grafica->setLabels(array('Barcelona','New York','Londres','Paris','Berlin','Tokio','El Cairo'));
        $grafica->setData(
          array(
              'Profit' => array(23,45,65,12,34,45,88),
              'Cost' => array(13,34,54,11,34,35,48),
          ));
          $grafica->setBackgroundcolor(
              array(
                  TypeColors::aqua,
                  TypeColors::dark_green
              )
          );
          $grafica->setBordercolor(
                array(
                    TypeColors::aqua,
                    TypeColors::dark_green

                )
          );
        $grafica->setHeight('150px');
        $grafica->setWidth('500px');
        $grafica->setTitle('Sample Charjs Bar');


        return $this->render('ChartjsBundle:test:testChart.html.twig',array('grafica'=>$grafica,'title'=>$grafica->getTitle()));
    }

    
}