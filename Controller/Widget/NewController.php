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

use TeckHouse\AnalyticsBundle\Document\Widget;
use TeckHouse\AnalyticsBundle\Form\Type\CreateWidgetType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller managing the creation of widgets
 * 
 * @author Mauro Foti <m.foti@teckouse.com>
 */
class NewController extends Controller
{

    /**
     * Create widget
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function indexAction(Request $request)
    {
        /** @var $widgetManager \TeckHouse\AnalyticsBundle\Manager\WidgetManager */
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

