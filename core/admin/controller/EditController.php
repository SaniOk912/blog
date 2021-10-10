<?php

namespace core\admin\controller;

class EditController extends BaseAdmin
{
    protected $action = 'edit';

    protected function inputData()
    {
        $this->execBase();

        $this->checkPost();

        $this->createTableData();

        $this->template = ADMIN_TEMPLATE . 'add';

        $this->createData();
    }

    protected function createData() {
        $id = $this->clearStr($this->parameters[$this->table]);

        $this->data = $this->model->get($this->table, [
            'where' => [$this->columns['id_row'] => $id]
        ]);

        $this->data && $this->data = $this->data[0];
    }
}