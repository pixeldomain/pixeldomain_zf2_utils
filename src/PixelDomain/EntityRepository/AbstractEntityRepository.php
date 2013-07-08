<?php

namespace PixelDomain\EntityRepository;

use PixelDomain\Log\Logger;
use PixelDomain\Exception\PixelDomainException;
use Doctrine\ORM\EntityRepository as DoctrineEntityRepository;


abstract class AbstractEntityRepository extends DoctrineEntityRepository
{

    /**
     * Get the logger object.
     *
     * @return PixelDomain\Log\Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * Set the logger object.
     *
     * @param PixelDomain\Log\Logger
     */
    public function setLogger(\PixelDomain\Log\Logger $logger)
    {
        $this->logger = $logger;
        return $this;
    }

}