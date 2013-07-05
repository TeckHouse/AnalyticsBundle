<?php

namespace TeckHouse\AnalyticsBundle\Document;

use TeckHouse\AnalyticsBundle\Document\CollectionInterface;

interface WidgetInterface
{

    /**
     * Set Data
     * 
     * Populate the data for the widget
     * 
     * @param array $collection
     */
    public function setCollections(array $collections);

    public function getCollections();

    public function addCollection(\TeckHouse\AnalyticsBundle\Document\Collection $collection);

    /**
     * Render the widget
     */
//    public function render();
}

?>
