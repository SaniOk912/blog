<?php

namespace core\user\controller;

class SearchController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();

        $this->createTableData();

        $this->userInfo = $this->model->get('users', [
            'fields' => ['id', 'username', 'age', 'status', 'img'],
            'where' => ['username' => $_POST['username']]
        ])[0];

//        print_arr($this->userInfo);
    }
}