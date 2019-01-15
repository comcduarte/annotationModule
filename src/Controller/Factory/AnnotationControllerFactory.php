<?php 
namespace Annotation\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Annotation\Controller\AnnotationController;

class AnnotationControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new AnnotationController();
        $controller->setDbAdapter($container->get('annotation-model-primary-adapter'));
        return $controller;
    }
}