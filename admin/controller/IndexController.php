<?php

namespace admin\controller;

class IndexController extends BaseAdmin
{
    protected function inputData()
    {
        $this->execBase();

        $this->createTableData();

        $this->createData();
        print_arr($this->columns);
    }
}