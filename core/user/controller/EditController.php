<?php

namespace core\user\controller;

class EditController extends BaseUser
{
    protected $action = 'edit';

    protected function inputData()
    {
        $this->execBase();

        $this->createTableData();

        $this->template = TEMPLATE . 'add';

        $this->createData();

        $this->createOutputForms();

        if(isset($_SESSION['id'])) $this->checkPost();

//        if($this->checkEdit()) echo '12345';

    }

    protected function createData() {
        $id = $this->clearStr($this->parameters[$this->table]);

        $this->data = $this->model->get($this->table, [
            'where' => [$this->columns['id_row'] => $id]
        ]);

        $this->data && $this->data = $this->data[0];

        if($this->table !== 'users') {
            if($this->data['author_id'] !== $_SESSION['id']) $this->data = [];
        }else{
            if($this->data['id'] !== $_SESSION['id']) $this->data = [];
        }

    }

}