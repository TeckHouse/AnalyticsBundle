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

use TeckHouse\AnalyticsBundle\Document\CollectionInterface;

/**
 * @author Mauro Foti <m.foti@teckhouse.com>
 */
interface WidgetInterface
{
    /**
     * Gets the Widget name
     */
    public function getName();
    
    /**
     * Sets the Widget name
     * 
     * The value must be searchable string
     * 
     * @param string $name
     */
    public function setName($name);

    /**
     * Gets the Widget type
     */
    public function getType();

    /**
     * Sets the Widget type
     * 
     * The widget type must be a defined Document
     * 
     * @param string $name
     * 
     * @return Widget
     */
    public function setType($type);

    /**
     * Gets the Widget label
     */
    public function getLabel();

    /**
     * Sets the Widget label
     * 
     * the label is used to show the title of the widget
     * 
     * @param string $label
     * 
     * @return Widget
     */
    public function setLabel($label);

    /**
     * Gets the Widget template
     */
    public function getTemplate();

    /**
     * Sets the Widget template
     * 
     * The string must rappresent a valid template file
     * 
     * @param string $template
     * 
     * @return Widget
     */
    public function setTemplate($template);
    
    /**
     * Gets the Widget Collections array
     */
    public function getCollections();
    
    /**
     * Sets the Widget collections
     * 
     * The array must contains a list of collectionName
     * 
     * @param array $collections
     * 
     * @return Widget
     */
    public function setCollections(array $collections);

    /**
     * Reset the collections list
     * 
     * @return Widget
     */
    public function removeCollections();
    
    /**
     * Adds a collection to the list of the widget's collection
     * 
     * @param \TeckHouse\AnalyticsBundle\Document\Collection $collection
     * 
     * @return Widget
     */
    public function addCollection(\TeckHouse\AnalyticsBundle\Document\Collection $collection);
    
    /**
     * Removes a collection from the list of the widget's collection
     * 
     * @param \TeckHouse\AnalyticsBundle\Document\Collection $collection
     * 
     * @return Widget
     */
    public function removeCollection(\TeckHouse\AnalyticsBundle\Document\Collection $collection);
}

?>
