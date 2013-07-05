<?php

namespace TeckHouse\AnalyticsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TeckHouse\AnalyticsBundle\Document\WidgetInterface;
use TeckHouse\AnalyticsBundle\Document\CollectionInterface;
use TeckHouse\AnalyticsBundle\Document\CollectionData;

class DefaultController extends Controller
{
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
    
    public function showWidgetAction($name)
    {

        $widget = $this->get("teckhouse_analytics.widget_manager")->findOneByName($name);
        
        if(is_null($widget) || ! $widget instanceOf WidgetInterface){
            echo "Error: Widget Not Found"; die;
        }
        
        return $this->render($widget->getTemplate(), array("widget" => $widget));
    }
}
