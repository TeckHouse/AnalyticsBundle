<?php

namespace TeckHouse\AnalyticsBundle\Manager;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use TeckHouse\AnalyticsBundle\Document\WidgetInterface;
use TeckHouse\AnalyticsBundle\Manager\CollectionManager;

class WidgetManager
{

    protected $class;
    protected $repository;
    protected $objectManager;
    protected $collectionManager;
    protected $supportedWidgetTypes;

    public function __construct(ManagerRegistry $doctrine, CollectionManager $cm, /* WidgetInterface */ $class, array $supportedWidgetType = array())
    {
        $this->collectionManager = $cm;
        $this->objectManager = $doctrine->getManager('default');
        $this->repository = $this->objectManager->getRepository($class);
        $this->class = $class;
        $this->supportedWidgetTypes = $supportedWidgetType;
    }

    public function setWidget($name, $label, $type, $collectionNames = array())
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

    public function deleteWidget(WidgetInterface $widget)
    {
        $this->objectManager->remove($widget);
        $this->objectManager->flush();
    }

    public function updateWidget(WidgetInterface $widget, $andFlush = true)
    {
        $this->objectManager->persist($widget);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    public function findOneByName($name, $class = null)
    {
        return $this->findOneBy(array('name' => $name), $class);
    }

    public function findOneBy(array $criteria, $class = null)
    {
        return $this->repository->findOneBy($criteria);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function getClassByType($type)
    {
        if (array_key_exists($type, $this->supportedWidgetTypes)) {
            return $this->supportedWidgetTypes[$type];
        }

        return null;
    }

    public function getClassRepository($class)
    {
        return $this->getObjectManager()->getClassMetadata($class)->getName();
    }

    public function getRepositoryByClass($class)
    {
        return $this->getObjectManager()->getRepository($class);
    }

    public function getObjectManager()
    {
        return $this->objectManager;
    }
}