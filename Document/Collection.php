<?php

namespace TeckHouse\AnalyticsBundle\Document;

use TeckHouse\AnalyticsBundle\Document\CollectionInterface as CInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ODM\Document()
 */
class Collection implements CInterface
{
        
    /** 
     * @ODM\Id 
     */
    protected $id;
    
    /**
     * @ODM\String
     * @Assert\NotBlank()
     */
    protected $collectionName;
    
    /**
     * @ODM\EmbedMany(
     *  targetDocument="TeckHouse\AnalyticsBundle\Document\CollectionData" 
     * )
     */
    protected $collectionData;
    //repositoryMethod="getCollectionData"
    
    
    public function __construct($name)
    {
        $this->setCollectionName($name);
        $this->collectionData = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set collectionName
     *
     * @param string $collectionName
     * @return self
     */
    public function setCollectionName($collectionName)
    {
        $this->collectionName = $collectionName;
        return $this;
    }

    /**
     * Get collectionName
     *
     * @return string $collectionName
     */
    public function getCollectionName()
    {
        return $this->collectionName;
    }

    /**
     * Add collectionData
     *
     * @param TeckHouse\AnalyticsBundle\Document\CollectionData $collectionData
     */
    public function addCollectionData(\TeckHouse\AnalyticsBundle\Document\CollectionData $collectionData)
    {
        $this->collectionData[] = $collectionData;
    }

    /**
     * Remove collectionData
     *
     * @param TeckHouse\AnalyticsBundle\Document\CollectionData $collectionData
     */
    public function removeCollectionData(\TeckHouse\AnalyticsBundle\Document\CollectionData $collectionData)
    {
        $this->collectionData->removeElement($collectionData);
    }

    /**
     * Get collectionData
     *
     * @return Doctrine\Common\Collections\Collection $collectionData
     */
    public function getCollectionData()
    {
        return $this->collectionData;
    }
    
    public function __toString()
    {
        return $this->getCollectionName();
    }
}
