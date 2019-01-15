<?php 
namespace Annotation;

use Zend\Db\Adapter\Adapter;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'annotation-model-primary-adapter' => function ($container) {
                    return new Adapter($container->get('annotation-model-primary-adapter-config'));
                }
            ],
        ];
    }
}