<?php

namespace TeckHouse\AnalyticsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TeckHouseAnalyticsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
//        $container->setAlias('teckhouse_analytics.document_manager', $config['service']['document_manager']);
        $container->setAlias('teckhouse_analytics.collection_manager', $config['service']['collection_manager']);
        $container->setAlias('teckhouse_analytics.widget_manager', $config['service']['widget_manager']);
        
        $menuDefinition = $container->getDefinition(
                'teckhouse_analytics.menu_builder'
        );

        $wdigetManagerDefinition = $container->getDefinition(
                'teckhouse_analytics.widget_manager.default'
        );
          
        foreach($config['widgets'] as $key => $widget ){
            
            $widgetTypes = $container->getParameter('teckhouse_analytics.widget.types');
            if (!isset($widgetTypes[$widget['type']])){
                throw New \Exception("Widget type not allowed");
            } 
            
            $collections = array();
            foreach ($widget['collections'] as $collectionName => $value) {
                $collections[] = $collectionName;
            }
            
            // Register Widget
            $wdigetManagerDefinition->addMethodCall('setWidget', array($key, $widget['label'], $widget['type'], $collections));
            
//            // Register Menu call
//            $menuDefinition->addMethodCall('addMenuWidgetItem', array($key, $widget["label"]));
        }
        
//        $widgetManager = $container->get('teckhouse_analytics.widget_manager');
        
//        foreach($config['widget'] as $key => $widget ){
//            $class = $container->get("teckhouse_analytics.widget.".$widget['type']);
//            print_r($class); die;
//            $widgetManager->setWidget($key);
//        }
    }
}
