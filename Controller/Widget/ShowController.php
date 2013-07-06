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

use TeckHouse\AnalyticsBundle\Document\WidgetInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller managing the visualization of widgets
 * 
 * @author Mauro Foti <m.foti@teckouse.com>
 */
class ShowController extends Controller
{

    /**
     * Show widget $name
     * 
     * @param String $name
     */
    
    public function indexAction($name)
    {
        $widget = $this->get("teckhouse_analytics.widget_manager")->findOneByName($name);
        
        if(is_null($widget) || ! $widget instanceOf WidgetInterface){
            echo "Error: Widget Not Found"; die;
        }
        
        return $this->render($widget->getTemplate(), array("widget" => $widget));
        
    }
}