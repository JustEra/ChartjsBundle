<?php

namespace Aldaflux\ChartjsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

use Symfony\Component\HttpKernel\Kernel;


class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder   = new TreeBuilder('chartjs');
        $rootNode = $treeBuilder->getRootNode();
        
//        $rootNode = $builder->root('chartjs');
        
        $rootNode
            ->children()
                ->arrayNode('animation')
                      ->children()
                          ->scalarNode('duration')
                                ->defaultValue('1000')
                          ->end()
                          ->scalarNode('easing')
                                ->defaultValue('easeOutQuart')
                          ->end()
                      ->end()
                ->end()
                ->arrayNode('layout')
                       ->children()
                          ->scalarNode('padding')
                              ->defaultValue('0')
                          ->end()
                       ->end()
                ->end()
                ->arrayNode('title')
                    ->children()
                            ->scalarNode('display')
                                ->defaultValue('false')
                            ->end()
                            ->scalarNode('position')
                                ->defaultValue('top')
                            ->end()
                            ->scalarNode('fontSize')
                                 ->defaultValue('12')
                            ->end()
                            ->scalarNode('fontFamily')
                                ->defaultValue("'Helvetica Neue', 'Helvetica', 'Arial', sans-serif")
                            ->end()
                            ->scalarNode('fontColor')
                                ->defaultValue('#666')
                            ->end()
                            ->scalarNode('fontStyle')
                                ->defaultValue('bold')
                            ->end()
                            ->scalarNode('padding')
                                ->defaultValue('10')
                            ->end()
                            ->scalarNode('text')
                                ->defaultValue('')
                            ->end()
                    ->end()
                ->end()
                ->arrayNode('legend')
                       ->children()
                          ->scalarNode('padding')
                                 ->defaultValue('0')
                          ->end()
                          ->scalarNode('display')
                              ->defaultValue('true')
                          ->end()
                          ->scalarNode('position')
                               ->defaultValue('top')
                          ->end()
                          ->scalarNode('fullWidth')
                                ->defaultValue('true')
                          ->end()
                          ->scalarNode('reverse')
                               ->defaultValue('false')
                          ->end()

                       ->arrayNode('labels')
                           ->children()
                                ->scalarNode('boxWidth')
                                    ->defaultValue('40')
                                ->end()
                                ->scalarNode('fontSize')
                                    ->defaultValue('12')
                                ->end()
                                ->scalarNode('fontStyle')
                                    ->defaultValue('normal')
                                ->end()
                                ->scalarNode('fontColor')
                                   ->defaultValue('#666')
                                ->end()
                                ->scalarNode('padding')
                                    ->defaultValue('false')
                                ->end()
                                ->scalarNode('fontFamily')
                                    ->defaultValue("'Helvetica Neue', 'Helvetica', 'Arial', sans-serif")
                                ->end()
                                ->scalarNode('usePointStyle')
                                    ->defaultValue('false')
                                ->end()
                            ->end()
                       ->end()
                ->end()
              ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}