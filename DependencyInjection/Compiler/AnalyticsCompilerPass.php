<?php

/*
 * This file is part of the TeckHouseAnalyticsBundle package.
 *
 * (c) TeckHouse <http://www.teckouse.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TeckHouse\AnalyticsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Mauro Foti <m.foti@teckhouse.com>
 */
class AnalyticsCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('teckhouse_analytics.menu_builder.default')) {
            return;
        }

        if (!$container->hasDefinition('teckhouse_analytics.widget_manager.default')) {
            return;
        }

        $menuDefinition = $container->getDefinition(
                'teckhouse_analytics.menu_builder'
        );

        $wdigetManagerDefinition = $container->getDefinition(
                'teckhouse_analytics.widget_manager'
        );

        $taggedServices = $container->findTaggedServiceIds(
                'teckhouse_analytics.widget'
        );

//        $config = $container->getParameter('teckhouse_analytics');
//
//        foreach ($taggedServices as $id => $tagAttributes) {
//            foreach ($tagAttributes as $attributes) {
//                
//                $widget = new Reference($id);
//                
//                $menuDefinition->addMethodCall(
//                        'addMenuWidgetItem', array($widget, $attributes["group"], $attributes["label"])
//                );
//                
//                $wdigetManagerDefinition->addMethodCall(
//                        'setWidget', array($widget, $id)
//                );
//            }  
//        }
    }

}

?>