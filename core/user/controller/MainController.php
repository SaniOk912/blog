<?php

namespace core\user\controller;

class MainController extends BaseUser
{
    protected $posts;

    protected function inputData()
    {
        $this->execBase();

        $this->createTableData();

        $this->createData(['fields' => ['password', 'date']]);

//        $this->checkLike();

        $this->posts = $this->model->get('posts', [
            'fields' => ['*']
        ]);

        print_arr(date("H:i:s, j F, Y"));
    }
}