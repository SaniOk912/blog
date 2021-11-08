<?php

namespace core\user\controller;

class MainController extends BaseUser
{

    protected function inputData()
    {
        $this->execBase();

        $this->createMainData();

//        print_arr($this->userInfo);
//        print_arr($this->posts);
//        print_arr($this->comments);
    }

    protected function createMainData()
    {
        $id = key($this->parameters);

        $this->userInfo = $this->model->get('users', [
            'fields' => ['id', 'username', 'img', 'age', 'status'],
            'where' => ['id' => $id]
        ])[0];

        $this->createPostsData('author_id');
    }
}