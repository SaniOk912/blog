<?php

namespace core\user\controller;

class MainController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();

        $this->createTableData();

        $this->createData(['fields' => ['password', 'date']]);

//        $smth = $this->model->get('table, table2', [
//            'fields' => ['field1', 'field2'],
////            'where' => ['1' => 'w']
//        ]);

//        return "$smth . <br>";
//        print_arr($this->model);
    }
}