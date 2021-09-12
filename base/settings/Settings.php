<?php

namespace base\settings;

use base\controller\Singleton;

class Settings
{
    use Singleton;

    private $routes = [
        'admin' => [
            'alias' => 'admin',
            'path' => 'admin/controller/',
            'routes' => [

            ]
        ],
        'settings' => [
            'path' => 'base/settings/'
        ],
        'user' => [
            'path' => 'user/controller/',
            'hrUrl' => false,
            'routes' => [

            ]
        ],
        'default' => [
            'controller' => 'IndexController',
            'inputMethod' => 'inputData',
            'outputMethod' => 'outputData'
        ]
    ];

    static public function get($property) {
        return self::instance()->$property;
    }
}