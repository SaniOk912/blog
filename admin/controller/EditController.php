<?php

namespace admin\controller;

class EditController extends BaseAdmin
{
    protected function inputData()
    {
        $this->action = 'edit';
        $this->execBase();
        $this->template = ADMIN_TEMPLATE . 'add';

        $this->createTableData();

        $this->createData(['where' => ['id' => $this->id]]);
        $this->data = $this->data[0];
        print_arr($this->data);

        $this->checkPost();
    }
}