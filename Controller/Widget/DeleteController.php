<?php

/*
 * This file is part of the TeckHouseAnalyticsBundle package.
 *
 * (c) TeckHouse <http://www.teckouse.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TeckHouse\AnalyticsBundle\Controller\Widget;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller managing the delete of widgets
 * 
 * @author Mauro Foti <m.foti@teckouse.com>
 */
class DeleteController extends Controller
{

    /**
     * Delete widget $name
     * 
     * @param String $name
     */
    public function indexAction($name)
    {
        /** @var $widgetManager \TeckHouse\AnalyticsBundle\Manager\WidgetManager */
        $widgetManager = $this->get('teckhouse_analytics.widget_manager');

        $widgetManager->deleteWidget(
                $widgetManager->findByName($name)
        );

        $this->get('session')->setFlash('success', "widget deleted");
        
        return $this->redirect($this->generateUrl('teckhouse_analytics_dashboard'));
        
    }

}

