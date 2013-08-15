<?php

namespace PixelDomain\Entity;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractEntity implements ServiceLocatorAwareInterface
{
    /**
     * @var Zend\ServiceManager\ServiceLocatorInterface The Service Manager
     */
    protected $serviceLocator;

    public function __isset($name)
    {
        if (in_array($name, array_keys(get_object_vars($this)))) {
            return true;
        }
        return false;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function populate($data = array())
    {
        foreach (array_keys(get_object_vars($this)) as $attribute) {
            if (isset($data[$attribute])) {
                $this->$attribute = $data[$attribute];
            }
        }
    }

    /**
     * Get the logger object.
     *
     * @return PixelDomain\Log\Logger
     */
    public function getLogger()
    {
        return $this->serviceLocator->get('PixelDomain\Log\Logger');
    }

    /**
     * Required as class implements ServiceLocatorAwareInterface
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Required as class implements ServiceLocatorAwareInterface
     *
     * @return ServiceLocator
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}