<?php

/*
 * This file is part of the TeckHouseAnalyticsBundle package.
 *
 * (c) TeckHouse <http://www.teckouse.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace TeckHouse\AnalyticsBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use TeckHouse\AnalyticsBundle\Manager\WidgetManager;

/**
 * Main menu
 * 
 * @author Mauro Foti <m.foti@teckhouse.com>
 */
class MenuBuilder extends ContainerAware
{

    private $factory;
    private $widgetManager;
    private $menuItems;

    public function __construct(FactoryInterface $factory, WidgetManager $wm)
    {
        $this->factory = $factory;
        $this->widgetManager = $wm;
        $this->menuItems = array();
    }

    public function widgetMenu(\Symfony\Component\Security\Core\SecurityContext $security)
    {

        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');

//      Security Proof of Concept
//        if ($security->isGranted('ROLE_ANALYTICS') || $security->isGranted('ROLE_'.$menuItem['group'])) {
//        }

        $menu->addChild('Dashboard', array('route' => "teckhouse_analytics_dashboard"));

        foreach ($this->widgetManager->findAll() as $widget){
            $menu->addChild($widget->getLabel(), array(
                        'route' => "teckhouse_analytics_widget_show",
                        'routeParameters' => array('name' => $widget->getName())))
                    ;
        }
        $menu->addChild('New Widget', array('route' => "teckhouse_analytics_widget_new"));
        
        return $menu;
    }

}