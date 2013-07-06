<?php

/*
 * This file is part of the TeckHouseAnalyticsBundle package.
 *
 * (c) TeckHouse <http://www.teckouse.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace TeckHouse\AnalyticsBundle\Document;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ODM\EmbeddedDocument
 * 
 * @author Mauro Foti <m.foti@teckouse.com>
 */
class CollectionData
{
    
    /** 
     * @ODM\Id 
     */
    protected $id;
    
    /**
     * @ODM\String
     */
    protected $name;
    
    /**
     * @ODM\Int
     */
    protected $value;
    
    /**
     * @ODM\Int
     */
    protected $int;
    
    /**
     * @ODM\Int
     */
    protected $min;
    
    /**
     * @ODM\Int
     */
    protected $max;
    
    /**
     * @ODM\String
     */
    protected $values;
    
    /**
     * @ODM\String
     */
    protected $content;
    
    /**
     * @ODM\String
     */
    protected $trend;
    
    /**
     * @ODM\String
     */
    protected $status;
    
    /**
     * @ODM\Date
     * @Gedmo\Timestampable(on="create")
     * @Assert\Date()
     */
    protected $timestamp;
    
    /**
     * @ODM\ReferenceOne(targetDocument="TeckHouse\AnalyticsBundle\Document\Collection", cascade={"all"}, inversedBy="collectionData")
     */
    protected $collection;
    

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
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param int $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return int $value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set int
     *
     * @param int $int
     * @return self
     */
    public function setInt($int)
    {
        $this->int = $int;
        return $this;
    }

    /**
     * Get int
     *
     * @return int $int
     */
    public function getInt()
    {
        return $this->int;
    }

    /**
     * Set min
     *
     * @param int $min
     * @return self
     */
    public function setMin($min)
    {
        $this->min = $min;
        return $this;
    }

    /**
     * Get min
     *
     * @return int $min
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Set max
     *
     * @param int $max
     * @return self
     */
    public function setMax($max)
    {
        $this->max = $max;
        return $this;
    }

    /**
     * Get max
     *
     * @return int $max
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Set values
     *
     * @param string $values
     * @return self
     */
    public function setValues($values)
    {
        $this->values = $values;
        return $this;
    }

    /**
     * Get values
     *
     * @return string $values
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set trend
     *
     * @param string $trend
     * @return self
     */
    public function setTrend($trend)
    {
        $this->trend = $trend;
        return $this;
    }

    /**
     * Get trend
     *
     * @return string $trend
     */
    public function getTrend()
    {
        return $this->trend;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return string $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set collection
     *
     * @param $collection
     * @return self
     */
    public function setCollection(\TeckHouse\AnalyticsBundle\Document\Collection $collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Get collection
     *
     * @return $collection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Set timestamp
     *
     * @param date $timestamp
     * @return self
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * Get timestamp
     *
     * @return date $timestamp
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
