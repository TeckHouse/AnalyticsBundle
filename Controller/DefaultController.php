<?php

/*
 * This file is part of the TeckHouseAnalyticsBundle package.
 *
 * (c) TeckHouse <http://www.teckouse.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TeckHouse\AnalyticsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TeckHouse\AnalyticsBundle\Document\WidgetInterface;
use TeckHouse\AnalyticsBundle\Document\CollectionInterface;
use TeckHouse\AnalyticsBundle\Document\CollectionData;

/**
 * @author Mauro Foti <m.foti@teckouse.com>
 */
class DefaultController extends Controller
{
    
    /**
     * Dashboard
     */
    public function indexAction()
    {
        
        /* 
         * Example
         
        $dm = $this->get('doctrine.odm.mongodb.document_manager');
        $collectionManager = $this->get('teckhouse_analytics.collection_manager');
        $widgetManager = $this->get('teckhouse_analytics.widget_manager');
        
        $collection1 = $collectionManager->getCollection('counterTest');
        $collection2 = $collectionManager->getCollection('counterTest2');
        
        $widget = $widgetManager->setWidget('test1', "test", "counter");
        
        $data1 = New CollectionData();
        $data1->setValue(1);
        $collection1->addCollectionData($data1);
        
        $data2 = New CollectionData();
        $data2->setValue(1);
        $collection2->addCollectionData($data2);
        
        if(!$widget instanceOf WidgetInterface){
            echo "error widget"; var_dump($widget); die;
        }
        
        if(!$collection1 instanceOf CollectionInterface){
            echo "error collection"; var_dump($collection1); die;
        }
        
        $widget->addCollection($collection1);
        $widget->addCollection($collection2);
        
        $dm->persist($data1);
        $dm->persist($data2);
        $dm->persist($widget);
                
        $dm->flush();
        */
        
        return $this->render('TeckHouseAnalyticsBundle:Default:index.html.twig');
    }
}
