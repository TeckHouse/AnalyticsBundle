<?php

namespace TeckHouse\AnalyticsBundle\Controller\Widget;

use TeckHouse\AnalyticsBundle\Document\Widget;
use TeckHouse\AnalyticsBundle\Form\Type\CreateWidgetType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewController extends Controller
{

    public function indexAction(Request $request)
    {
        $widgetManager = $this->get('teckhouse_analytics.widget_manager');
        $supportedWidgetTypes = $this->container->getParameter('teckhouse_analytics.widget.types');

        $widget = New Widget; 
        $form = $this->createForm(new CreateWidgetType($supportedWidgetTypes), $widget);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $widgetManager->updateWidget($widget);
                $this->get('session')->setFlash('success', "widget created");
                return $this->redirect($this->generateUrl('teckhouse_analytics_dashboard'));
            }
        }
        
        return $this->render('TeckHouseAnalyticsBundle:Widget:new.html.twig', array(
                    "form" => $form->createView()
        ));
    }

}

