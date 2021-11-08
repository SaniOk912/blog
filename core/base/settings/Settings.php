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
            'formTemplates' => '',
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
            'formTemplates' => 'core/user/view/include/form_templates',
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
        'users' => ['username', 'age', 'img', 'status'],
        'posts' => ['id', 'name', 'content', 'img', 'date', 'likes', 'author_id'],
        'comments' => ['author_id', 'post_id', 'content', 'date', 'likes'],
        'messages' => ['message', 'is_read', 'date']
    ];

    private $forms = [
        'text' => ['name', 'username', 'email'],
        'textarea' => ['content'],
        'img' => ['img'],
    ];

    static public function get($property) {
        return self::instance()->$property;
    }
}