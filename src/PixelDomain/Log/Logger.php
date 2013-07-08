<?php

namespace PixelDomain\Log;


class Logger
{
    /**
     * @var Zend\Log\Logger The logger object
     */
    protected $logger;

    /**
     * Set up the Zend logger object.
     *
     * @param string $environment The project environment
     */
    public function __construct($environment)
    {
        $this->logger = new \Zend\Log\Logger;

        if ($environment == 'development') {
            $streamWriter = new \Zend\Log\Writer\Stream('php://output');
            $this->logger->addWriter($streamWriter);
        }

        $fileWriter = new \Zend\Log\Writer\Stream('data/logs/app.log');
        $filter = new \Zend\Log\Filter\Priority(\Zend\Log\Logger::ERR);
        $fileWriter->addFilter($filter);

        $this->logger->addWriter($fileWriter);
    }

    /**
     * Magic method that acts as proxy to Zend the logger.
     *
     * @param string $name The method name that was called
     * @param array  $arguments The method arguments
     */
    public function __call($name, $arguments) {
        $allowedMethods = array('emerg', 'alert', 'crit', 'err', 'warn', 'notice', 'info', 'debug');
        $message = $arguments[0];

        if (sizeof($arguments) == 2) {
            $extraInfo = $arguments[1];
            if (in_array($name, $allowedMethods)) {
                $this->logger->$name($message, $extraInfo);
            }
        } else {
            if (in_array($name, $allowedMethods)) {
                $this->logger->$name($message);
            }
        }
    }

}