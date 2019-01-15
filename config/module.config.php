<?php 
namespace Annotation;

use Annotation\View\Helper\Annotations;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
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