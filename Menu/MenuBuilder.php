<?php

namespace TeckHouse\AnalyticsBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use TeckHouse\AnalyticsBundle\Manager\WidgetManager;

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