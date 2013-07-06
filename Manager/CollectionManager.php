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

use Doctrine\Common\Persistence\ManagerRegistry;
use TeckHouse\AnalyticsBundle\Document\CollectionInterface;

/**
 * Collection Manager
 * 
 * This class is defined as service teckhouse_analytics.collection_manager.default
 * and is used to manage collections
 * 
 * @author Mauro Foti <m.foti@teckouse.com>
 */
class CollectionManager
{
    protected $class;
    protected $repository;
    protected $objectManager;

    /**
     * Constructor
     * 
     * @param \Doctrine\Common\Persistence\ManagerRegistry $doctrine
     * @param string $class
     */
    public function __construct(ManagerRegistry $doctrine, $class)
    {
        $this->objectManager = $doctrine->getManager('default');
        $this->repository = $this->objectManager->getRepository($class);

        $metadata = $this->objectManager->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * Find or create collection
     * 
     * @param string $name
     * @return CollectionInterface
     */
    public function getCollection($name)
    {
        $collection = $this->findOneByName($name);

        if (!$collection) {
            $collection = $this->createCollection($name);
        }

        $this->updateCollection($collection);

        return $collection;
    }

    /**
     * Return an empty collection instance
     * 
     * @param string $name
     * @return CollectionInterface
     */
    public function createCollection($name)
    {
        $class = $this->getClass();
        $collection = new $class($name);

        return $collection;
    }

    /**
     * Delete Collection
     * 
     * @param CollectionInterface $collection
     */
    public function deleteCollection(CollectionInterface $collection)
    {
        $this->objectManager->remove($collection);
        $this->objectManager->flush();
    }

    /**
     * Update Collection
     * 
     * Save Collection
     * 
     * @param CollectionInterface $collection
     * @param bool $andFlush
     */
    public function updateCollection(CollectionInterface $collection, $andFlush = true)
    {
        $this->objectManager->persist($collection);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * Find one by name
     * 
     * @param string $name
     * @return CollectionInterface
     */
    public function findOneByName($name)
    {
        return $this->findOneBy(array('collectionName' => $name));
    }

    /**
     * Find one by criteria
     * 
     * @param array $criteria
     * @return CollectionInterface
     */
    public function findOneBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * Find all collections
     * 
     * @return array
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    private function getClass()
    {
        return $this->class;
    }
}

?>
