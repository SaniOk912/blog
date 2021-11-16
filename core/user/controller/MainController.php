<?php

namespace core\user\controller;

class MainController extends BaseUser
{

    protected function inputData()
    {
        $this->execBase();

        $this->createMainData();
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