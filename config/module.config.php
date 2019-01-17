<?php 
namespace Annotation;

use Annotation\View\Helper\Annotations;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Literal;
use Annotation\Controller\AnnotationController;
use Zend\Router\Http\Segment;
use Annotation\Controller\Factory\AnnotationControllerFactory;

return [
    'router' => [
        'routes' => [
            'annotation' => [
                'type' => Literal::class,
                'priority' => 1,
                'options' => [
                    'route' => '/annotation',
                    'defaults' => [
                        'controller' => AnnotationController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'annotation' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/annotation[/:action[/:uuid]]',
                            'defaults' => [
                                'controller' => AnnotationController::class,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'acl' => [
        'guest' => [
            'annotation' => ['index'],
        ],
        'member' => [
            'annotation' => ['index'],
            'annotation/annotation' => ['index', 'create', 'update', 'delete'],
        ],
    ],
    'controllers' => [
        'factories' => [
            AnnotationController::class => AnnotationControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'annotation-model-primary-adapter-config' => 'dog-model-primary-adapter-config',
        ],
    ],
    'view_helpers' => [
        'factories' => [
            Annotations::class => InvokableFactory::class,
        ],
        'aliases' => [
            'annotations' => Annotations::class,
        ],
    ],
];