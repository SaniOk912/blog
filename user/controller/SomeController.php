<?php

namespace user\controller;

class SomeController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();

        $smth = $this->model->get('table, table2', [
            'fields' => ['field1', 'field2'],
//            'where' => ['1' => 'w']
        ]);

//        return "$smth . <br>";
//        print_arr($this->model);
    }
}