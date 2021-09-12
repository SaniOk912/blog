<?php

namespace admin\controller;

use base\settings\Settings;

class ShowController extends BaseAdmin
{
    protected function inputData()
    {
        $this->execBase();

        $this->createTableData();

        $this->createData();
        print_arr($this->columns);
    }
}