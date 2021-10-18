<?php

namespace core\user\controller;

class MainController extends BaseUser
{
    protected $posts;

    protected function inputData()
    {
        $this->execBase();

//        $this->createTableData('comments');
//
//        print_arr($this->table);

        $this->createData(['users', 'posts']);

        $this->posts = $this->model->get('posts', [
            'fields' => ['*']
        ]);
    }
}