<?php

/*
 * This file is part of the TeckHouseAnalyticsBundle package.
 *
 * (c) TeckHouse <http://www.teckouse.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TeckHouse\AnalyticsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 * 
 * @author Mauro Foti <m.foti@teckouse.com>
 */
class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('teckhouse_analytics');

        // TODO: Get from parameters
        $supportedWidgetType = array('counter', 'leaderboard');
        
        $rootNode
                ->fixXmlConfig('teckhouse_analytics')
                ->children()
                ->arrayNode('widgets')
                        ->useAttributeAsKey('name')
                        ->prototype('array')
                            ->treatNullLike(array())
                            ->children()
                                ->scalarNode('label')
                                    ->isRequired()
                                    ->cannotBeEmpty()
                                    ->end()
                                ->scalarNode('type')
                                    ->validate()
                                        ->ifNotInArray($supportedWidgetType)
                                        ->thenInvalid('The type %s is not supported. Please choose one of '.json_encode($supportedWidgetType))
                                    ->end()
                                    ->isRequired()
                                    ->cannotBeEmpty()
                                    ->end()
                                ->arrayNode('collections')
                                    ->useAttributeAsKey('collection_name')
                                    ->treatNullLike(array())
                                    ->requiresAtLeastOneElement()
                                    ->prototype('array')
                                    ->end()
                            ->end()
                        ->end()
                   ->end()
                ->end()
        ;

        $this->addServiceSection($rootNode);
        $this->addTemplateSection($rootNode);
        
        return $treeBuilder;
    }
    
    /**
     * Adds default service definition to the root node
     * 
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    private function addServiceSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('service')
                    ->addDefaultsIfNotSet()
                        ->children()
//                            ->scalarNode('document_manager')->defaultValue('teckhouse_analytics.document_manager.default')->end()
                            ->scalarNode('collection_manager')->defaultValue('teckhouse_analytics.collection_manager.default')->end()
                            ->scalarNode('widget_manager')->defaultValue('teckhouse_analytics.widget_manager.default')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds template extension definition to the root node
     * 
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    
    private function addTemplateSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('template')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('engine')->defaultValue('twig')->end()
                    ->end()
                ->end()
            ->end();
    }

}
