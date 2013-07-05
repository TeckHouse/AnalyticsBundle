<?php

namespace TeckHouse\AnalyticsBundle\Controller\Widget;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeleteController extends Controller
{

    public function indexAction($name)
    {
        $widgetManager = $this->get('teckhouse_analytics.widget_manager');

        $widgetManager->deleteWidget(
                $widgetManager->findByName($name)
        );

        $this->get('session')->setFlash('success', "widget deleted");
        
        return $this->redirect($this->generateUrl('teckhouse_analytics_dashboard'));
        
    }

}

