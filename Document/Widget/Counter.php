<?php

namespace TeckHouse\AnalyticsBundle\Document\Widget;

use TeckHouse\AnalyticsBundle\Document\Widget;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class Counter extends Widget
{
    protected $type = "counter";
    protected $template = "TeckHouseAnalyticsBundle:WidgetTemplate:counter.html.twig";
    
    /**
     * @var $id
     */
    protected $id;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $label
     */
    protected $label;

    /**
     * @var \TeckHouse\AnalyticsBundle\Document\Collection
     */
    protected $collections = array();


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
     * Set label
     *
     * @param string $label
     * @return self
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Get label
     *
     * @return string $label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Add collections
     *
     * @param \TeckHouse\AnalyticsBundle\Document\Collection $collections
     */
    public function addCollection(\TeckHouse\AnalyticsBundle\Document\Collection $collections)
    {
        $this->collections[] = $collections;
    }

    /**
     * Remove collections
     *
     * @param \TeckHouse\AnalyticsBundle\Document\Collection $collections
     */
    public function removeCollection(\TeckHouse\AnalyticsBundle\Document\Collection $collections)
    {
        $this->collections->removeElement($collections);
    }

    /**
     * Get collections
     *
     * @return Doctrine\Common\Collections\Collection $collections
     */
    public function getCollections()
    {
        return $this->collections;
    }
}
