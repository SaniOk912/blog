<?php

namespace core\user\controller;

class AddController extends BaseUser
{
    protected $action = 'add';
    protected function inputData()
    {
        $this->execBase();

        $this->createTableData();

        $this->createOutputForms();

        $_POST['author_id'] = $_SESSION['id'];
        $_POST['date'] = date('Y-m-d H:i:s');
        $this->checkPost();
    }

}