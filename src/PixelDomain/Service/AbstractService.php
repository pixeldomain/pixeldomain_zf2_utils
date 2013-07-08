<?php

namespace PixelDomain\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractService implements ServiceLocatorAwareInterface
{
    /**
     * @var Zend\ServiceManager\ServiceLocatorInterface The Service Manager
     */
    protected $serviceLocator;

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
     * Get the Doctrine entity manager.
     *
     * @return Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->serviceLocator->get('doctrine.entitymanager.orm_default');
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