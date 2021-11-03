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
        print_arr($_REQUEST);
        print_arr($_POST);
    }

    protected function createData() {
        $id = $this->clearStr($this->parameters[$this->table]);

        $this->data = $this->model->get($this->table, [
            'where' => [$this->columns['id_row'] => $id]
        ]);

        $this->data && $this->data = $this->data[0];
    }

//    protected function inputData()
//    {
//        $this->execBase();
//
//        foreach ($this->parameters as $key => $value) {
//            $tables[] = $key;
//            $where[] = ['id' => $value];
//        }
//
//        $this->createData($tables, $where);
//
//        print_arr($this->data);
//    }
}