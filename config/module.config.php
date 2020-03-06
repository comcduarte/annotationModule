<?php 
namespace Annotation;

use Annotation\View\Helper\Annotations;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Literal;
use Annotation\Controller\AnnotationController;
use Zend\Router\Http\Segment;
use Annotation\Controller\Factory\AnnotationControllerFactory;
use Annotation\Controller\AnnotationConfigController;
use Annotation\Controller\Factory\AnnotationConfigControllerFactory;

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
                    'config' => [
                        'type' => Segment::class,
                        'priority' => 100,
                        'options' => [
                            'route' => '/config[/:action]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => AnnotationConfigController::class,
                            ],
                        ],
                    ],
                    'default' => [
                        'type' => Segment::class,
                        'priority' => -100,
                        'options' => [
                            'route' => '/[:action[/:uuid]]',
                            'defaults' => [
                                'action' => 'index',
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
            'annotation/config' => ['index','clear','create'],
        ],
    ],
    'controllers' => [
        'factories' => [
            AnnotationConfigController::class => AnnotationConfigControllerFactory::class,
            AnnotationController::class => AnnotationControllerFactory::class,
        ],
    ],
    'navigation' => [
        'default' => [
            'settings' => [
                'label' => 'Settings',
                'route' => 'home',
                'class' => 'dropdown',
                'pages' => [
                    'annotations' => [
                        'label' => 'Annotation Settings',
                        'route' => 'annotation/config',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'annotation-model-primary-adapter-config' => 'model-primary-adapter-config',
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