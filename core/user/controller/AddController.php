<?php

namespace core\user\controller;

class AddController extends BaseUser
{
    protected $action = 'add';
    protected function inputData()
    {
        $this->execBase();

        $this->createTableData();

//        $this->createData();

        $this->createOutputForms();

        $this->checkPost();
    }

}