<?php

namespace PixelDomain;

use PixelDomain\Log\Logger;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }

    public function getServiceConfig()
    {
        return array(
            'aliases'   => array(),
            'factories' => array(
                'PixelDomain\Log\Logger' =>  function($sm) {
                    $config = $sm->get('application')->getConfig();
                    $logger = new Logger($config['environment']);
                    return $logger;
                }
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

}