<?php

namespace TeckHouse\AnalyticsBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use TeckHouse\AnalyticsBundle\Document\CollectionInterface;

class CollectionManager
{

    protected $class;
    protected $repository;
    protected $objectManager;

    public function __construct(ManagerRegistry $doctrine, $class)
    {
        $this->objectManager = $doctrine->getManager('default');
        $this->repository = $this->objectManager->getRepository($class);

        $metadata = $this->objectManager->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    public function getCollection($name)
    {
        $collection = $this->findOneByName($name);

        if (!$collection) {
            $collection = $this->createCollection($name);
        }

        $this->updateCollection($collection);

        return $collection;
    }

    public function createCollection($name)
    {
        $class = $this->getClass();
        $collection = new $class($name);

        return $collection;
    }

    public function deleteCollection(CollectionInterface $collection)
    {
        $this->objectManager->remove($collection);
        $this->objectManager->flush();
    }

    public function updateCollection(CollectionInterface $collection, $andFlush = true)
    {
        $this->objectManager->persist($collection);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    public function getClass()
    {
        return $this->class;
    }

    public function findOneByName($name)
    {
        return $this->findOneBy(array('collectionName' => $name));
    }

    public function findOneBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

}

?>
