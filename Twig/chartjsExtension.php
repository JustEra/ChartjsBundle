<?php

namespace Aldaflux\ChartjsBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\Environment;


use Symfony\Component\DependencyInjection\ContainerInterface;

class chartjsExtension  extends AbstractExtension
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

    }

    public function getName() {
        return 'chartjs_extensions';
    }

    public function getFunctions()
    {

        return array(
              'chartjs_canvas' => new TwigFunction('chartjs_canvas', array($this, 'chartjs_canvas'),array('is_safe' => array('html'),'needs_environment' => true)),
              'getParameter' =>   new TwigFunction('parameter', function($name) {   return $this->container->getParameter($name); }),
        );
    }

    //we could define more than one map in a page
    public function chartjs_canvas(Environment $twig,$id='myChart',$width='500px',$height='500px',$graphic)
    {
        return $twig->render('@Chartjs/default/chartjsRender.html.twig',array('id' => $id,'width'=>$width,'height'=>$height,'graphic'=>$graphic));
    }

}