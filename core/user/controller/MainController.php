<?php

namespace core\user\controller;

class MainController extends BaseUser
{
    protected $posts;

    protected function inputData()
    {
        $this->execBase();

//        $this->createTableData();

        $this->createData();

//        $this->posts = $this->model->get('posts', [
//            'fields' => ['*']
//        ]);
    }
}