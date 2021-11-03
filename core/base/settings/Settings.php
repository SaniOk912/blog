<?php

namespace core\base\settings;

use core\base\controller\Singleton;

class Settings
{
    use Singleton;

    private $routes = [
        'admin' => [
            'alias' => 'admin',
            'path' => 'core/admin/controller/',
            'routes' => [
                'main' => '\core\user\controller\Main/inputData/outputNewData'
            ]
        ],
        'settings' => [
            'path' => 'core/base/settings/'
        ],
        'user' => [
            'path' => 'core/user/controller/',
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

    private $tableFields = [
        'users' => ['username', 'date', 'img', 'alias'],
        'posts' => ['name', 'content', 'img', 'date', 'likes'],
        'comments' => ['author_id', 'post_id', 'content', 'date', 'likes'],
        'messages' => ['message', 'is_read', 'date']
    ];

    static public function get($property) {
        return self::instance()->$property;
    }
}