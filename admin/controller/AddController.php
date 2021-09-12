<?php

namespace admin\controller;

class AddController extends BaseAdmin
{
    protected function inputData()
    {
        $this->action = 'add';
        $this->execBase();

        $this->createTableData();

        $this->checkPost();
    }
}