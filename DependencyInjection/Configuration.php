<?php

namespace TeckHouse\AnalyticsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritDoc}
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
