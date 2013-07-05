<?php

namespace TeckHouse\AnalyticsBundle\Controller\Widget;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TeckHouse\AnalyticsBundle\Document\WidgetInterface;

class ShowController extends Controller
{

    public function indexAction($name)
    {
        $widget = $this->get("teckhouse_analytics.widget_manager")->findOneByName($name);
        
        if(is_null($widget) || ! $widget instanceOf WidgetInterface){
            echo "Error: Widget Not Found"; die;
        }
        
        return $this->render($widget->getTemplate(), array("widget" => $widget));
        
    }
}