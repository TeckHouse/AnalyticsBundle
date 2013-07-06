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

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ODM\Document
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 * @ODM\DiscriminatorField(fieldName="discriminator")
 * @ODM\DiscriminatorMap({
 *      "counter"       = "TeckHouse\AnalyticsBundle\Document\Widget\Counter", 
 *      "leaderboard"   = "TeckHouse\AnalyticsBundle\Document\Widget\Leaderboard"
 * })
 * 
 * @author Mauro Foti <m.foti@teckhouse.com>
 */
class Widget implements WidgetInterface
{

    /**
     *
     * @ODM\Id(strategy="AUTO")
     * 
     * @var MongoId 
     */
    protected $id;

    /**
     *
     * @ODM\String 
     * @ODM\Index(unique=true, order="asc") 
     * @Assert\NotBlank()
     * 
     * @var string
     */
    protected $name;

    /**
     *
     * @ODM\String
     * @Assert\NotBlank()
     * 
     * @var string
     */
    protected $type;

    /**
     *
     * @ODM\String
     * @Assert\NotBlank()
     * 
     * @var string
     */
    protected $label;

    /**
     *
     * @ODM\String
     * @Assert\NotBlank()
     * 
     * @var string
     */
    protected $template;

    /**
     * @ODM\ReferenceMany(targetDocument="\TeckHouse\AnalyticsBundle\Document\Collection", nullable=false)
     */
    protected $collections;

    public function __construct()
    {
        $this->collections = New \Doctrine\Common\Collections\ArrayCollection;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        
        if (is_null($this->getName())){
            $this->setName(preg_replace('/\s+/', '', $label));
        }

        return $this;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        if ($template != "")
            $this->template = $template;

        return $this;
    }

    public function setCollections(array $collections)
    {
        if (!is_array($collections)) {
            throw \Exception("Widget data must be an array");
        }

        $this->removeCollections();
        
        foreach ($collections as $collection) {
            if (!$collection instanceOf CollectionInterface) {
                throw \Exception("Not valid collection");
            }

            $this->addCollection($collection);
        }

        return $this;
    }

    public function removeCollections()
    {
        $this->collections = New \Doctrine\Common\Collections\ArrayCollection;

        return $this;
    }

    public function addCollection(\TeckHouse\AnalyticsBundle\Document\Collection $collection)
    {
        $this->collections[] = $collection;

        return $this;
    }

    public function removeCollection(\TeckHouse\AnalyticsBundle\Document\Collection $collection)
    {
        $this->collections->removeElement($collection);

        return $this;
    }

//    public function delta($param, $value)
//    {
//
//        $deltaParam = 'delta' . ucfirst($param);
//        $getParam = 'get' . ucfirst($param);
//        $setParam = 'set' . ucfirst($param);
//
//        if (method_exists($this->model, $deltaParam)) {
//            $this->model->$deltaParam($value);
//        } else if (method_exists($this->model, $getParam) && method_exists($this->model, $setParam)) {
//            if ($param > 0) {
//                $this->model->$setParam(
//                        $this->model->$getParam() + $value
//                );
//            } else if ($param < 0) {
//                $this->model->$setParam(
//                        $this->model->$getParam() - $value
//                );
//            }
//        }
//    }
//
//    public function get($param)
//    {
//        $getParam = 'get' . ucfirst($param);
//
//        if (method_exists($this->model, $getParam)) {
//            return $this->model->$getParam();
//        }
//
//        return null;
//    }
//
//    public function set($param, $value)
//    {
//        $setParam = 'set' . ucfirst($param);
//
//        if (method_exists($this->model, $setParam)) {
//            $this->model->$setParam($value);
//        }
//    }

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
     * Get collections
     *
     * @return Doctrine\Common\Collections\Collection $collections
     */
    public function getCollections()
    {
        return $this->collections;
    }

}
