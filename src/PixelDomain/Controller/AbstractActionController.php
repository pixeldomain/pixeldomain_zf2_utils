<?php

namespace PixelDomain\Controller;

use Zend\Mvc\Controller\AbstractActionController as ZendAbstractActionController;


abstract class AbstractActionController extends ZendAbstractActionController
{
    /**
     * Get the logger object.
     *
     * @return PixelDomain\Log\Logger
     */
    public function getLogger()
    {
        return $this->getServiceLocator()->get('PixelDomain\Log\Logger');
    }

     /**
     * Get the Doctrine entity manager.
     *
     * @return Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    }

}