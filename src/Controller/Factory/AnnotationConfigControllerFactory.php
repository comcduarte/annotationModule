<?php 
namespace Annotation\Controller\Factory;

use Annotation\Controller\AnnotationConfigController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AnnotationConfigControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new AnnotationConfigController();
        $adapter = $container->get('annotation-model-primary-adapter');
        $controller->setDbAdapter($adapter);
        return $controller;
    }
}