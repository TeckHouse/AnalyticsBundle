<?php

/*
 * This file is part of the TeckHouseAnalyticsBundle package.
 *
 * (c) TeckHouse <http://www.teckouse.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TeckHouse\AnalyticsBundle\Manager;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use TeckHouse\AnalyticsBundle\Document\WidgetInterface;
use TeckHouse\AnalyticsBundle\Manager\CollectionManager;

/**
 * Widget Manager
 * 
 * this class is the default one for the teckhouse_analytics.widget_manager service
 * 
 * @author Mauro Foti <m.foti@teckouse.com>
 */
class WidgetManager
{
    protected $class;
    protected $repository;
    protected $objectManager;
    protected $collectionManager;
    protected $supportedWidgetTypes;

    /**
     * Constructor.
     * 
     * @param \Doctrine\Common\Persistence\ManagerRegistry $doctrine
     * @param \TeckHouse\AnalyticsBundle\Manager\CollectionManager $cm
     * @param widget class $class
     * @param array $supportedWidgetType
     */
    public function __construct(ManagerRegistry $doctrine, CollectionManager $cm, /* WidgetInterface */ $class, array $supportedWidgetType = array())
    {
        $this->collectionManager = $cm;
        $this->objectManager = $doctrine->getManager('default');
        $this->repository = $this->objectManager->getRepository($class);
        $this->class = $class;
        $this->supportedWidgetTypes = $supportedWidgetType;
    }

    /**
     * Set Widget
     * 
     * Find or create a widget and sets collection
     * 
     * @param string $name
     * @param string $label
     * @param string $type
     * @param array $collectionNames
     * @return TeckHouse\AnalyticsBundle\Document\WidgetInterface
     */
    public function setWidget($name, $label, $type, array $collectionNames = array())
    {
        $class = $this->getClassByType($type);
        $widget = $this->findOneByName($name, $class);

        if (!$widget || !$widget instanceOf WidgetInterface) {
            $widget = $this->createWidget($name, $label, $class);
        }

        foreach ($collectionNames as $collectionName) {
            $collections[] = $this->collectionManager->getCollection($collectionName);
        }

        if (isset($collections)){
            $widget->setCollections($collections);
        }
        
        $this->updateWidget($widget);

        return $widget;
    }

    /**
     * Create a new widget
     * 
     * @param string $name
     * @param string $label
     * @param string $class
     * @return \TeckHouse\AnalyticsBundle\Document\WidgetInterface
     * @throws Exception
     */
    public function createWidget($name, $label, $class)
    {
        $class = $this->getClassRepository($class);
        $widget = new $class();
        
        if (!$widget instanceOf WidgetInterface) {
            throw New Exception("Widget class not valid");
        }

        $widget->setName($name);
        $widget->setLabel($label);

        return $widget;
    }

    /**
     * Delete widget
     * 
     * @param \TeckHouse\AnalyticsBundle\Document\WidgetInterface $widget
     */
    public function deleteWidget(WidgetInterface $widget)
    {
        $this->objectManager->remove($widget);
        $this->objectManager->flush();
    }

    /**
     * Update widget
     * 
     * Save Widget
     * 
     * @param \TeckHouse\AnalyticsBundle\Document\WidgetInterface $widget
     * @param bool $andFlush
     */
    public function updateWidget(WidgetInterface $widget, $andFlush = true)
    {
        $this->objectManager->persist($widget);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * Find one widget by name
     * 
     * if the class is define find specifc widget type
     * 
     * @param string $name
     * @param string $class
     * @return \TeckHouse\AnalyticsBundle\Document\WidgetInterface
     */
    public function findOneByName($name, $class = null)
    {
        return $this->findOneBy(array('name' => $name), $class);
    }

    /**
     * Find one by $criteria
     * 
     * @param array $criteria
     * @param string $class
     * @return \TeckHouse\AnalyticsBundle\Document\WidgetInterface
     */
    public function findOneBy(array $criteria, $class = null)
    {
        if (!is_null($class)){
            $this->getRepositoryByClass($class)->findOneBy($criteria);
        }
        
        return $this->repository->findOneBy($criteria);
    }

    /**
     * Return all widgets
     * 
     * @return \TeckHouse\AnalyticsBundle\Document\WidgetInterface
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * Return the class of a give widget type
     * 
     * @param type $type
     * @return null|class
     */
    public function getClassByType($type)
    {
        if (array_key_exists($type, $this->supportedWidgetTypes)) {
            return $this->supportedWidgetTypes[$type];
        }

        return null;
    }

    private function getClassRepository($class)
    {
        return $this->getObjectManager()->getClassMetadata($class)->getName();
    }

    private function getRepositoryByClass($class)
    {
        return $this->getObjectManager()->getRepository($class);
    }

    private function getObjectManager()
    {
        return $this->objectManager;
    }
    
    /**
     * Render the widget
     */
//    public function render();
}